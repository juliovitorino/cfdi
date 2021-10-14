<?php 

// importar dependencias
require_once 'CampanhaSorteioFilaCriacaoBusiness.php';
require_once 'CampanhaSorteioFilaCriacaoConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* CampanhaSorteioFilaCriacaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaSorteioFilaCriacaoBusiness
* Camada de negócio CampanhaSorteioFilaCriacao - camada responsável pela lógica de negócios de CampanhaSorteioFilaCriacao do sistema. 
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
* @since 17/06/2021 08:10:22
*
*/


class CampanhaSorteioFilaCriacaoBusinessImpl implements CampanhaSorteioFilaCriacaoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_SORTEIO_FILA_CRIACAO::CSFC_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_SORTEIO_FILA_CRIACAO sem critério de paginação
* @param $daofactory
* @return List<CampanhaSorteioFilaCriacaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoId_CasoPorStatus() - Carrega apenas um registro com base no id_caso  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaSorteioFilaCriacaoDTO
*/ 
    public function pesquisarMaxPKAtivoId_CasoPorStatus($daofactory, $id_caso,$status)
    { 
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        $maxid = $dao->loadMaxId_CasoPK($id_caso,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaSorteioFilaCriacaoDTO->id
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


        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaSorteioFilaCriacaoDTO->id
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
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);

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
* @return List<CampanhaSorteioFilaCriacaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_SORTEIO_FILA_CRIACAO usando a Primary Key CSFC_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaSorteioFilaCriacaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO_FILA_CRIACAO usando a Primary Key CSFC_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaSorteioFilaCriacaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);

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
* inserir() - inserir um registro com base no CampanhaSorteioFilaCriacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaSorteioFilaCriacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaSorteioFilaCriacaoConstantes::LEN_ID, CampanhaSorteioFilaCriacaoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_caso com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_ID_CASO
    $ok = $this->validarTamanhoCampo($dto->id_caso, CampanhaSorteioFilaCriacaoConstantes::LEN_ID_CASO, CampanhaSorteioFilaCriacaoConstantes::DESC_ID_CASO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->qtLoteTicketCriar com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_QTLOTETICKETCRIAR
    $ok = $this->validarTamanhoCampo($dto->qtLoteTicketCriar, CampanhaSorteioFilaCriacaoConstantes::LEN_QTLOTETICKETCRIAR, CampanhaSorteioFilaCriacaoConstantes::DESC_QTLOTETICKETCRIAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    // Efetua validações no campo $dto->status com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaSorteioFilaCriacaoConstantes::LEN_STATUS, CampanhaSorteioFilaCriacaoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaSorteioFilaCriacaoConstantes::LEN_DATACADASTRO, CampanhaSorteioFilaCriacaoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaSorteioFilaCriacaoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaSorteioFilaCriacaoConstantes::LEN_DATAATUALIZACAO, CampanhaSorteioFilaCriacaoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaSorteioFilaCriacaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioFilaCriacaoDAO de forma geral
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

    public function listarCampanhaSorteioFilaCriacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaSorteioFilaCriacaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioFilaCriacaoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_CasoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma atualização de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CASO_ID
* @param $daofactory
* @param $id
* @param $id_caso
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/
    public function atualizarId_CasoPorPK($daofactory,$id_caso,$id)
    {
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Caso($id, $id_caso)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarQtloteticketcriarPorPK() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma atualização de Qtde lotes de tickets diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CSFC_QT_LOTE
* @param $daofactory
* @param $id
* @param $qtLoteTicketCriar
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/
    public function atualizarQtloteticketcriarPorPK($daofactory,$qtLoteTicketCriar,$id)
    {
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateQtloteticketcriar($id, $qtLoteTicketCriar)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorId_Caso() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma busca de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CASO_ID
*
* @param $id_caso
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/
    public function pesquisarPorId_Caso($daofactory,$id_caso)
    { 
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        return $dao->loadId_Caso($id_caso);
    }

/**
*
* pesquisarPorQtloteticketcriar() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma busca de Qtde lotes de tickets diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CSFC_QT_LOTE
*
* @param $qtLoteTicketCriar
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/
    public function pesquisarPorQtloteticketcriar($daofactory,$qtLoteTicketCriar)

    { 
        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        return $dao->loadQtloteticketcriar($qtLoteTicketCriar);
    }


/**
*
* listarCampanhaSorteioFilaCriacaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioFilaCriacaoDAO de forma geral
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

    public function listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioFilaCriacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaSorteioFilaCriacaoDTO
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
