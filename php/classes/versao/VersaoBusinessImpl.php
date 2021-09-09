<?php 

// importar dependencias
require_once 'VersaoBusiness.php';
require_once 'VersaoConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* VersaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface VersaoBusiness
* Camada de negócio Versao - camada responsável pela lógica de negócios de Versao do sistema. 
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
* @since 06/10/2019 15:59:51
*
*/


class VersaoBusinessImpl implements VersaoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (VERSAO::VERS_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de VERSAO sem critério de paginação
* @param $daofactory
* @return List<VersaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* PesquisarMaxPK() - Carrega o mais recente
* @param $daofactory
* @param $status
* @return VersaoDTO
*/ 
    public function PesquisarMaxPK($daofactory)
    { 
        $dao = $daofactory->getVersaoDAO($daofactory);
        $maxid = $dao->loadMaxPK();
        return $this->carregarPorID($daofactory, $maxid);
    }
    
/**
* PesquisarMaxPKAtivoVersaoPorStatus() - Carrega apenas um registro com base no versao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return VersaoDTO
*/ 
    public function PesquisarMaxPKAtivoVersaoPorStatus($daofactory, $versao,$status)
    { 
        $dao = $daofactory->getVersaoDAO($daofactory);
        $maxid = $dao->loadMaxVersaoPK($versao,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* PesquisarMaxPKAtivoVersao() - Carrega apenas um registro com base no versao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return VersaoDTO
*/ 
public function PesquisarMaxPKAtivoVersao($daofactory, $versao)
{ 
    $dao = $daofactory->getVersaoDAO($daofactory);
    $maxid = $dao->loadMaxSoVersaoPK($versao);
    return $this->carregarPorID($daofactory, $maxid);
}

/**
* atualizar() - atualiza apenas um registro com base no dto VersaoDTO->id
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


        $dao = $daofactory->getVersaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto VersaoDTO->id
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
        $dao = $daofactory->getVersaoDAO($daofactory);

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
* @return List<VersaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getVersaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela VERSAO usando a Primary Key VERS_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return VersaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getVersaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela VERSAO usando a Primary Key VERS_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return VersaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getVersaoDAO($daofactory);

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
* inserir() - inserir um registro com base no VersaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe VersaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho VersaoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, VersaoConstantes::LEN_ID, VersaoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->versao com tamanho VersaoConstantes::LEN_VERSAO
    $ok = $this->validarTamanhoCampo($dto->versao, VersaoConstantes::LEN_VERSAO, VersaoConstantes::DESC_VERSAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getVersaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarVersaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) VersaoDAO de forma geral
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

    public function listarVersaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getVersaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countVersaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listVersaoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarVersaoPorPK() - Usado para invocar a classe de negócio VersaoBusinessImpl de forma geral
* realizar uma atualização de Versão diretamente na tabela VERSAO campo VERS_TX_VERSAO
* @param $daofactory
* @param $id
* @param $versao
* @return VersaoDTO
*
* 
*/
    public function atualizarVersaoPorPK($daofactory,$versao,$id)
    {
        $dao = $daofactory->getVersaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVersao($id, $versao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorVersao() - Usado para invocar a classe de negócio VersaoBusinessImpl de forma geral
* realizar uma busca de Versão diretamente na tabela VERSAO campo VERS_TX_VERSAO
*
* @param $versao
* @return VersaoDTO
*
* 
*/
    public function pesquisarPorVersao($daofactory,$versao)
    { 
        $dao = $daofactory->getVersaoDAO($daofactory);
        return $dao->loadVersao($versao);
    }


/**
*
* listarVersaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) VersaoDAO de forma geral
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

    public function listarVersaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getVersaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countVersaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listVersaoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos VersaoDTO
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
