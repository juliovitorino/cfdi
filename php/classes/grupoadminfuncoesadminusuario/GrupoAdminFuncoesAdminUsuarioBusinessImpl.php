<?php 

// importar dependencias
require_once 'GrupoAdminFuncoesAdminUsuarioBusiness.php';
require_once 'GrupoAdminFuncoesAdminUsuarioConstantes.php';
require_once 'GrupoAdminFuncoesAdminUsuarioHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* GrupoAdminFuncoesAdminUsuarioBusinessImpl - Classe de implementação dos métodos de negócio para a interface GrupoAdminFuncoesAdminUsuarioBusiness
* Camada de negócio GrupoAdminFuncoesAdminUsuario - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdminUsuario do sistema. 
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
* @since 20/08/2021 19:25:25
*
*/


class GrupoAdminFuncoesAdminUsuarioBusinessImpl implements GrupoAdminFuncoesAdminUsuarioBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO::GAFAU_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO sem critério de paginação
* @param $daofactory
* @return List<GrupoAdminFuncoesAdminUsuarioDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdgrupoadmfuncoesadmPorStatus() - Carrega apenas um registro com base no idGrupoAdmFuncoesAdm  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return GrupoAdminFuncoesAdminUsuarioDTO
*/ 
    public function pesquisarMaxPKAtivoIdgrupoadmfuncoesadmPorStatus($daofactory, $idGrupoAdmFuncoesAdm,$status)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        $maxid = $dao->loadMaxIdgrupoadmfuncoesadmPK($idGrupoAdmFuncoesAdm,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto GrupoAdminFuncoesAdminUsuarioDTO->id
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


        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto GrupoAdminFuncoesAdminUsuarioDTO->id
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
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);

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
* @return List<GrupoAdminFuncoesAdminUsuarioDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO usando a Primary Key GAFAU_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return GrupoAdminFuncoesAdminUsuarioDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO usando a Primary Key GAFAU_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return GrupoAdminFuncoesAdminUsuarioDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);

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
* inserirGrupoAdminFuncoesAdminUsuario() - inserir um registro com base no GrupoAdminFuncoesAdminUsuarioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirGrupoAdminFuncoesAdminUsuario($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Regras de Negócio
    // ...
    

    //--- Tudo ok com regras de negócio. Pode inserir o registro 
    // Prepara registro  de bonificação


    return $this->inserir($daofactory, $dto);
}


/**
* inserir() - inserir um registro com base no GrupoAdminFuncoesAdminUsuarioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe GrupoAdminFuncoesAdminUsuarioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_ID, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idGrupoAdmFuncoesAdm com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_IDGRUPOADMFUNCOESADM
    $ok = $this->validarTamanhoCampo($dto->idGrupoAdmFuncoesAdm, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_IDGRUPOADMFUNCOESADM, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_IDGRUPOADMFUNCOESADM);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_ID_USUARIO, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_STATUS, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_DATACADASTRO, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho GrupoAdminFuncoesAdminUsuarioConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, GrupoAdminFuncoesAdminUsuarioConstantes::LEN_DATAATUALIZACAO, GrupoAdminFuncoesAdminUsuarioConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    return $retorno;
}

/**
*
* listarGrupoAdminFuncoesAdminUsuarioPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) GrupoAdminFuncoesAdminUsuarioDAO de forma geral
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

    public function listarGrupoAdminFuncoesAdminUsuarioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countGrupoAdminFuncoesAdminUsuarioPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listGrupoAdminFuncoesAdminUsuarioPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdgrupoadmfuncoesadmPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminUsuarioBusinessImpl de forma geral
* realizar uma atualização de ID grupo admin x função admin diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO campo GAFA_ID
* @param $daofactory
* @param $id
* @param $idGrupoAdmFuncoesAdm
* @return GrupoAdminFuncoesAdminUsuarioDTO
*
* 
*/
    public function atualizarIdgrupoadmfuncoesadmPorPK($daofactory,$idGrupoAdmFuncoesAdm,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdgrupoadmfuncoesadm($id, $idGrupoAdmFuncoesAdm)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminUsuarioBusinessImpl de forma geral
* realizar uma atualização de ID doo usuário diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return GrupoAdminFuncoesAdminUsuarioDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);

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
* pesquisarPorIdgrupoadmfuncoesadm() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminUsuarioBusinessImpl de forma geral
* realizar uma busca de ID grupo admin x função admin diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO campo GAFA_ID
*
* @param $idGrupoAdmFuncoesAdm
* @return GrupoAdminFuncoesAdminUsuarioDTO
*
* 
*/
    public function pesquisarPorIdgrupoadmfuncoesadm($daofactory,$idGrupoAdmFuncoesAdm)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        return $dao->loadIdgrupoadmfuncoesadm($idGrupoAdmFuncoesAdm);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminUsuarioBusinessImpl de forma geral
* realizar uma busca de ID doo usuário diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO campo USUA_ID
*
* @param $id_usuario
* @return GrupoAdminFuncoesAdminUsuarioDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }
/**
*
* listarGrupoAdminFuncoesAdminUsuarioUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) GrupoAdminFuncoesAdminUsuarioDAO de forma geral
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

    public function listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos GrupoAdminFuncoesAdminUsuarioDTO
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
