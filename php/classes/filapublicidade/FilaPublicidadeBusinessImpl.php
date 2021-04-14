<?php 

// importar dependencias
require_once 'FilaPublicidadeBusiness.php';
require_once 'FilaPublicidadeConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* FilaPublicidadeBusinessImpl - Classe de implementação dos métodos de negócio para a interface FilaPublicidadeBusiness
* Camada de negócio FilaPublicidade - camada responsável pela lógica de negócios de FilaPublicidade do sistema. 
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
* @since 19/09/2019 15:31:07
*
*/


class FilaPublicidadeBusinessImpl implements FilaPublicidadeBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (FILA_PUBLICIDADE::FIPU_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de FILA_PUBLICIDADE sem critério de paginação
* @param $daofactory
* @return List<FilaPublicidadeDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* PesquisarMaxPKAtivoId_Usua_PublicPorStatus() - Carrega apenas um registro com base no id_usua_public  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return FilaPublicidadeDTO
*/ 
    public function PesquisarMaxPKAtivoId_Usua_PublicPorStatus($daofactory, $id_usua_public,$status)
    { 
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        $maxid = $dao->loadMaxId_Usua_PublicPK($id_usua_public,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto FilaPublicidadeDTO->id
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


        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto FilaPublicidadeDTO->id
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
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

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
* @return List<FilaPublicidadeDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela FILA_PUBLICIDADE usando a Primary Key FIPU_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return FilaPublicidadeDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_PUBLICIDADE usando a Primary Key FIPU_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return FilaPublicidadeDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

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
* inserir() - inserir um registro com base no FilaPublicidadeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FilaPublicidadeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho FilaPublicidadeConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, FilaPublicidadeConstantes::LEN_ID, FilaPublicidadeConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usua_public com tamanho FilaPublicidadeConstantes::LEN_ID_USUA_PUBLIC
    $ok = $this->validarTamanhoCampo($dto->id_usua_public, FilaPublicidadeConstantes::LEN_ID_USUA_PUBLIC, FilaPublicidadeConstantes::DESC_ID_USUA_PUBLIC);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho FilaPublicidadeConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, FilaPublicidadeConstantes::LEN_ID_USUARIO, FilaPublicidadeConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_job com tamanho FilaPublicidadeConstantes::LEN_ID_JOB
    $ok = $this->validarTamanhoCampo($dto->id_job, FilaPublicidadeConstantes::LEN_ID_JOB, FilaPublicidadeConstantes::DESC_ID_JOB);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarFilaPublicidadePorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaPublicidadeDAO de forma geral
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

    public function listarFilaPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaPublicidadePorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_Usua_PublicPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID Usuário x Publicidade diretamente na tabela FILA_PUBLICIDADE campo USPU_ID
* @param $daofactory
* @param $id
* @param $id_usua_public
* @return FilaPublicidadeDTO
*
* 
*/
    public function atualizarId_Usua_PublicPorPK($daofactory,$id_usua_public,$id)
    {
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Usua_Public($id, $id_usua_public)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do Usuário diretamente na tabela FILA_PUBLICIDADE campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return FilaPublicidadeDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

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
* atualizarId_JobPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do Job diretamente na tabela FILA_PUBLICIDADE campo JOBS_ID
* @param $daofactory
* @param $id
* @param $id_job
* @return FilaPublicidadeDTO
*
* 
*/
    public function atualizarId_JobPorPK($daofactory,$id_job,$id)
    {
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Job($id, $id_job)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorId_Usua_Public() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID Usuário x Publicidade diretamente na tabela FILA_PUBLICIDADE campo USPU_ID
*
* @param $id_usua_public
* @return FilaPublicidadeDTO
*
* 
*/
    public function pesquisarPorId_Usua_Public($daofactory,$id_usua_public)
    { 
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        return $dao->loadId_Usua_Public($id_usua_public);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do Usuário diretamente na tabela FILA_PUBLICIDADE campo USUA_ID
*
* @param $id_usuario
* @return FilaPublicidadeDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorId_Job() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do Job diretamente na tabela FILA_PUBLICIDADE campo JOBS_ID
*
* @param $id_job
* @return FilaPublicidadeDTO
*
* 
*/
    public function pesquisarPorId_Job($daofactory,$id_job)

    { 
        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        return $dao->loadId_Job($id_job);
    }


/**
*
* listarFilaPublicidadeUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaPublicidadeDAO de forma geral
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

    public function listarFilaPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaPublicidadeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaPublicidadePorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos FilaPublicidadeDTO
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
