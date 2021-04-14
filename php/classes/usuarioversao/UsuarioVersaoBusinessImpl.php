<?php 

// importar dependencias
require_once 'UsuarioVersaoBusiness.php';
require_once 'UsuarioVersaoConstantes.php';

require_once '../usuarios/UsuarioHelper.php';
require_once '../versao/VersaoBusinessImpl.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* UsuarioVersaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioVersaoBusiness
* Camada de negócio UsuarioVersao - camada responsável pela lógica de negócios de UsuarioVersao do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/10/2019 16:44:47
*
*/


class UsuarioVersaoBusinessImpl implements UsuarioVersaoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_VERSAO::USVE_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_VERSAO sem critério de paginação
* @param $daofactory
* @return List<UsuarioVersaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* verificarVersaoSistema() - Verifica se a versão atual do dispositivo do usuário precisa de upgrade
* @param $daofactory
* @param $id_usuario
* @param $versao
* @return UsuarioVersaoDTO
*/ 
    public function verificarVersaoSistema($daofactory, $id_usuario, $versao)
    {
        // retorno padrao
        $retorno = new UsuarioVersaoDTO();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        // validacao do usuario
        if(! UsuarioHelper::isUsuarioValido($daofactory, $id_usuario) ){
            $retorno->msgcode = ConstantesMensagem::USUARIO_NAO_ENCONTRADO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return  $retorno;
        }

        // procura pela versao do sistema
        $versaobo = new VersaoBusinessImpl();
        $versaodto = $versaobo->PesquisarMaxPKAtivoVersao($daofactory, $versao);
//var_dump($versaodto);

        // Resultado válido?
        if($versaodto == NULL || $versaodto->id == NULL){
            $versaodto->msgcode = ConstantesMensagem::VERSAO_APP_INEXISTENTE;
            $versaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($versaodto->msgcode);
            return  $versaodto;
        }

        // Obtem a versão mais recente
        $recentedto = $versaobo->PesquisarMaxPK($daofactory);
//var_dump($recentedto);

        // Tá descontinuada?
        if($versaodto->status == ConstantesVariavel::STATUS_INATIVO){
            $versaodto->msgcode = ConstantesMensagem::VERSAO_DESCONTINUADA;
            $versaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($versaodto->msgcode,[
                ConstantesVariavel::P1 => $versao,
            ]);
            return  $versaodto;
        }

        // Tá em manutenção?
        if($versaodto->status == ConstantesVariavel::STATUS_MANUTENCAO){
            $versaodto->msgcode = ConstantesMensagem::VERSAO_EM_MANUTENCAO_TENTE_MAIS_TARDE;
            $versaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($versaodto->msgcode,[
                ConstantesVariavel::P1 => $versao,
            ]);
            return  $versaodto;
        }

        // Verifica se existe a versão do app + ID usuario existem
        $usvedto = $this->PesquisarMaxPKIdUsuarioIdVersao($daofactory, $id_usuario, $versaodto->id);
//var_dump($usvedto)        ;
        if($usvedto == NULL || $usvedto->id == NULL){
            // vamos inserir na lista deste usuario a versao atual do seu dispositivo
            $usvedto->id_usuario = $id_usuario;
            $usvedto->id_versao = $versaodto->id;
            if(! $this->inserir($daofactory, $usvedto)){
                $usvedto->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
                $usvedto->msgcodeString = MensagemCache::getInstance()->getMensagem($usvedto->msgcode);
                return  $usvedto;
            }
        }
        $usvedto->versao = $versaobo->carregarPorID($daofactory, $usvedto->id_versao);
//var_dump($usvedto)        ;

        // Forçar o usuário a fazer upgrade de versão
        if($usvedto->status == ConstantesVariavel::STATUS_INATIVO){
            $usvedto->msgcode = ConstantesMensagem::ATUALIZAR_VERSAO_DE_PARA_RECENTE;
            $usvedto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($usvedto->msgcode,[
                ConstantesVariavel::P1 => $versao,
                ConstantesVariavel::P2 => $recentedto->versao,
            ]);
            return  $usvedto;
        }

        // Forçar o usuário a fazer upgrade de versão
        if($usvedto->status == ConstantesVariavel::STATUS_ATIVO && $usvedto->id_versao != $recentedto->id){
            $usvedto->msgcode = ConstantesMensagem::VERSAO_DESATUALIZADA;
            $usvedto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($usvedto->msgcode,[
                ConstantesVariavel::P1 => $recentedto->versao,
            ]);
            return  $usvedto;
        }

        return $retorno;
    }

/**
* PesquisarMaxPKAtivoId_VersaoPorStatus() - Carrega apenas um registro com base no id_versao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioVersaoDTO
*/ 
    public function PesquisarMaxPKIdUsuarioIdVersao($daofactory, $id_usuario, $id_versao)
    { 
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        $maxid = $dao->loadMaxPKIdUsuarioIdVersao($id_usuario, $id_versao);
        return $this->carregarPorID($daofactory, $maxid);
    }


/**
* PesquisarMaxPKAtivoId_VersaoPorStatus() - Carrega apenas um registro com base no id_versao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioVersaoDTO
*/ 
    public function PesquisarMaxPKAtivoId_VersaoPorStatus($daofactory, $id_versao,$status)
    { 
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        $maxid = $dao->loadMaxId_VersaoPK($id_versao,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioVersaoDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO
*/ 

    public function atualizar($daofactory, $dto)    
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);


        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioVersaoDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO
*/ 
    
    public function deletar($daofactory, $dto)  
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);

        if(!$dao->delete($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

        return $retorno;
    }

/**
* listarPagina() - listar registros de forma paginada
* @param $daofactory
* @param $pag
* @param $qtde
*
* @return List<UsuarioVersaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_VERSAO usando a Primary Key USVE_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioVersaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_VERSAO usando a Primary Key USVE_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioVersaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        // obtem o status atual da campanha
        $dto = $this->carregarPorID($daofactory, $id);

            if($dao->updateStatus($id, $status)){   
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
* inserir() - inserir um registro com base no UsuarioVersaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioVersaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserir($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Efetua validações no campo $dto->id com tamanho UsuarioVersaoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioVersaoConstantes::LEN_ID, UsuarioVersaoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_versao com tamanho UsuarioVersaoConstantes::LEN_ID_VERSAO
    $ok = $this->validarTamanhoCampo($dto->id_versao, UsuarioVersaoConstantes::LEN_ID_VERSAO, UsuarioVersaoConstantes::DESC_ID_VERSAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho UsuarioVersaoConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, UsuarioVersaoConstantes::LEN_ID_USUARIO, UsuarioVersaoConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioVersaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarUsuarioVersaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioVersaoDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarUsuarioVersaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioVersaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioVersaoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_VersaoPorPK() - Usado para invocar a classe de negócio UsuarioVersaoBusinessImpl de forma geral
* realizar uma atualização de ID da versão diretamente na tabela USUARIO_VERSAO campo VERS_ID
* @param $daofactory
* @param $id
* @param $id_versao
* @return UsuarioVersaoDTO
*
* 
*/
    public function atualizarId_VersaoPorPK($daofactory,$id_versao,$id)
    {
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Versao($id, $id_versao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioVersaoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_VERSAO campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return UsuarioVersaoDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Usuario($id, $id_usuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Versao() - Usado para invocar a classe de negócio UsuarioVersaoBusinessImpl de forma geral
* realizar uma busca de ID da versão diretamente na tabela USUARIO_VERSAO campo VERS_ID
*
* @param $id_versao
* @return UsuarioVersaoDTO
*
* 
*/
    public function pesquisarPorId_Versao($daofactory,$id_versao)
    { 
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        return $dao->loadId_Versao($id_versao);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioVersaoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_VERSAO campo USUA_ID
*
* @param $id_usuario
* @return UsuarioVersaoDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }


/**
*
* listarUsuarioVersaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioVersaoDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarUsuarioVersaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioVersaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioVersaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioVersaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioVersaoDTO
*
* @param $campo
* @param $tamanho
* @param $coment
*
* @return DTOPadrao
*/ 
    public function validarTamanhoCampo($campo, $tamanho, $coment)    
    {
       // retorno default
       $retorno = new DTOPadrao();
       $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
   
       if(strlen($campo) > $tamanho){
          $retorno->msgcode = ConstantesMensagem::TAMANHO_DO_CAMPO_EXCEDE_LIMITE_PERMITIDO;
          $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode
          ,[
             ConstantesVariavel::P1 => $coment,
             ConstantesVariavel::P2 => $tamanho,
           ]);
       }
       return $retorno;
   }


}
?>
