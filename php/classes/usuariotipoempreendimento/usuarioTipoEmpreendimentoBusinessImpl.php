<?php 

// importar dependencias
require_once 'UsuarioTipoEmpreendimentoBusiness.php';
require_once 'UsuarioTipoEmpreendimentoConstantes.php';
require_once 'UsuarioTipoEmpreendimentoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* UsuarioTipoEmpreendimentoBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioTipoEmpreendimentoBusiness
* Camada de negócio UsuarioTipoEmpreendimento - camada responsável pela lógica de negócios de UsuarioTipoEmpreendimento do sistema. 
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
* @since 06/09/2021 09:56:34
*
*/


class UsuarioTipoEmpreendimentoBusinessImpl implements UsuarioTipoEmpreendimentoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_TIPO_EMPREENDIMENTO::USTE_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_TIPO_EMPREENDIMENTO sem critério de paginação
* @param $daofactory
* @return List<UsuarioTipoEmpreendimentoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdusuarioPorStatus() - Carrega apenas um registro com base no idUsuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioTipoEmpreendimentoDTO
*/ 
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario,$status)
    { 
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        $maxid = $dao->loadMaxIdusuarioPK($idUsuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioTipoEmpreendimentoDTO->id
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


        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioTipoEmpreendimentoDTO->id
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
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

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
* @return List<UsuarioTipoEmpreendimentoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_TIPO_EMPREENDIMENTO usando a Primary Key USTE_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioTipoEmpreendimentoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_TIPO_EMPREENDIMENTO usando a Primary Key USTE_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioTipoEmpreendimentoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

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
* inserirUsuarioTipoEmpreendimento() - inserir um registro com base no UsuarioTipoEmpreendimentoDTO. Alguns atributos dentro do DTO
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
public function inserirUsuarioTipoEmpreendimento($daofactory, $dto)
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
* inserir() - inserir um registro com base no UsuarioTipoEmpreendimentoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioTipoEmpreendimentoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioTipoEmpreendimentoConstantes::LEN_ID, UsuarioTipoEmpreendimentoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuario com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_IDUSUARIO
    $ok = $this->validarTamanhoCampo($dto->idUsuario, UsuarioTipoEmpreendimentoConstantes::LEN_IDUSUARIO, UsuarioTipoEmpreendimentoConstantes::DESC_IDUSUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idTipoEmpreendimento com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_IDTIPOEMPREENDIMENTO
    $ok = $this->validarTamanhoCampo($dto->idTipoEmpreendimento, UsuarioTipoEmpreendimentoConstantes::LEN_IDTIPOEMPREENDIMENTO, UsuarioTipoEmpreendimentoConstantes::DESC_IDTIPOEMPREENDIMENTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }
    // Efetua validações no campo $dto->status com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, UsuarioTipoEmpreendimentoConstantes::LEN_STATUS, UsuarioTipoEmpreendimentoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, UsuarioTipoEmpreendimentoConstantes::LEN_DATACADASTRO, UsuarioTipoEmpreendimentoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho UsuarioTipoEmpreendimentoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, UsuarioTipoEmpreendimentoConstantes::LEN_DATAATUALIZACAO, UsuarioTipoEmpreendimentoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

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
* listarUsuarioTipoEmpreendimentoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioTipoEmpreendimentoDAO de forma geral
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

    public function listarUsuarioTipoEmpreendimentoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioTipoEmpreendimentoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioTipoEmpreendimentoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdusuarioPorPK() - Usado para invocar a classe de negócio UsuarioTipoEmpreendimentoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_TIPO_EMPREENDIMENTO campo USUA_ID
* @param $daofactory
* @param $id
* @param $idUsuario
* @return UsuarioTipoEmpreendimentoDTO
*
* 
*/
    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id)
    {
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuario($id, $idUsuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdtipoempreendimentoPorPK() - Usado para invocar a classe de negócio UsuarioTipoEmpreendimentoBusinessImpl de forma geral
* realizar uma atualização de ID do tipo do empreendimento diretamente na tabela USUARIO_TIPO_EMPREENDIMENTO campo TIEM_ID
* @param $daofactory
* @param $id
* @param $idTipoEmpreendimento
* @return UsuarioTipoEmpreendimentoDTO
*
* 
*/
    public function atualizarIdtipoempreendimentoPorPK($daofactory,$idTipoEmpreendimento,$id)
    {
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdtipoempreendimento($id, $idTipoEmpreendimento)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }
/**
*
* pesquisarPorIdusuario() - Usado para invocar a classe de negócio UsuarioTipoEmpreendimentoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_TIPO_EMPREENDIMENTO campo USUA_ID
*
* @param $idUsuario
* @return UsuarioTipoEmpreendimentoDTO
*
* 
*/
    public function pesquisarPorIdusuario($daofactory,$idUsuario)
    { 
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->loadIdusuario($idUsuario);
    }

/**
*
* pesquisarPorIdtipoempreendimento() - Usado para invocar a classe de negócio UsuarioTipoEmpreendimentoBusinessImpl de forma geral
* realizar uma busca de ID do tipo do empreendimento diretamente na tabela USUARIO_TIPO_EMPREENDIMENTO campo TIEM_ID
*
* @param $idTipoEmpreendimento
* @return UsuarioTipoEmpreendimentoDTO
*
* 
*/
    public function pesquisarPorIdtipoempreendimento($daofactory,$idTipoEmpreendimento)

    { 
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->loadIdtipoempreendimento($idTipoEmpreendimento);
    }

/**
*
* listarUsuarioTipoEmpreendimentoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioTipoEmpreendimentoDAO de forma geral
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

    public function listarUsuarioTipoEmpreendimentoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioTipoEmpreendimentoDTO
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
