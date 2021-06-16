<?php 

// importar dependencias
require_once 'CampanhaSorteioBusiness.php';
require_once 'CampanhaSorteioConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* CampanhaSorteioBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaSorteioBusiness
* Camada de negócio CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
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
* @since 16/06/2021 12:57:19
*
*/


class CampanhaSorteioBusinessImpl implements CampanhaSorteioBusiness
{
     
    function __construct(){}

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_SORTEIO::CASO_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
     public function carregar($daofactory, $dto){}

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_SORTEIO sem critério de paginação
* @param $daofactory
* @return List<CampanhaSorteioDTO>[]
*/ 
     public function listarTudo($daofactory){}

/**
* pesquisarMaxPKAtivoId_CampanhaPorStatus() - Carrega apenas um registro com base no id_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaSorteioDTO
*/ 
    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status)
    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        $maxid = $dao->loadMaxId_CampanhaPK($id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaSorteioDTO->id
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


          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          if(!$dao->update($dto)){
            $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
     
          }
          // retorna situação
          return $retorno;

     }

/**
 * criarSorteio() - Cria todo o processo inicial do sorteio para uma campanha
 * 
 * @param $daofactory
 * @param $dto 
*/
     public function criarSorteio($daofactory, $dto)
     {
         // retorno default
         $retorno = new DTOPadrao();
         $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
         $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        // verificações gerais

        // Verificação de permissão



        // Incluir na base de sorteio da campanha
        $retorno = $this->inserir($daofactory, $dto);

        // Incluir na fila de criação de número pra não cair por timeout no provedor
        if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
        {
            // preenche a fila
        }

         return $retorno;

     }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaSorteioDTO->id
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
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* @return List<CampanhaSorteioDTO>[]
* @deprecated
*/ 

     public function listarPagina($daofactory, $pag, $qtde)
     {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
     }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaSorteioDTO
*/ 
     public function carregarPorID($daofactory, $id)
     { 
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          return $dao->loadPK($id);
     }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaSorteioDTO
*/ 
     public function atualizarStatus($daofactory, $id, $status)
     {
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* inserir() - inserir um registro com base no CampanhaSorteioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaSorteioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaSorteioConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaSorteioConstantes::LEN_ID, CampanhaSorteioConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho CampanhaSorteioConstantes::LEN_ID_CAMPANHA
    $ok = $this->validarTamanhoCampo($dto->id_campanha, CampanhaSorteioConstantes::LEN_ID_CAMPANHA, CampanhaSorteioConstantes::DESC_ID_CAMPANHA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nome com tamanho CampanhaSorteioConstantes::LEN_NOME
    $ok = $this->validarTamanhoCampo($dto->nome, CampanhaSorteioConstantes::LEN_NOME, CampanhaSorteioConstantes::DESC_NOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlRegulamento com tamanho CampanhaSorteioConstantes::LEN_URLREGULAMENTO
    $ok = $this->validarTamanhoCampo($dto->urlRegulamento, CampanhaSorteioConstantes::LEN_URLREGULAMENTO, CampanhaSorteioConstantes::DESC_URLREGULAMENTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->premio com tamanho CampanhaSorteioConstantes::LEN_PREMIO
    $ok = $this->validarTamanhoCampo($dto->premio, CampanhaSorteioConstantes::LEN_PREMIO, CampanhaSorteioConstantes::DESC_PREMIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataComecoSorteio com tamanho CampanhaSorteioConstantes::LEN_DATACOMECOSORTEIO
    $ok = $this->validarTamanhoCampo($dto->dataComecoSorteio, CampanhaSorteioConstantes::LEN_DATACOMECOSORTEIO, CampanhaSorteioConstantes::DESC_DATACOMECOSORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataFimSorteio com tamanho CampanhaSorteioConstantes::LEN_DATAFIMSORTEIO
    $ok = $this->validarTamanhoCampo($dto->dataFimSorteio, CampanhaSorteioConstantes::LEN_DATAFIMSORTEIO, CampanhaSorteioConstantes::DESC_DATAFIMSORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->maxTickets com tamanho CampanhaSorteioConstantes::LEN_MAXTICKETS
    $ok = $this->validarTamanhoCampo($dto->maxTickets, CampanhaSorteioConstantes::LEN_MAXTICKETS, CampanhaSorteioConstantes::DESC_MAXTICKETS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho CampanhaSorteioConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaSorteioConstantes::LEN_STATUS, CampanhaSorteioConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaSorteioConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaSorteioConstantes::LEN_DATACADASTRO, CampanhaSorteioConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaSorteioConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaSorteioConstantes::LEN_DATAATUALIZACAO, CampanhaSorteioConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaSorteioPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
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

    public function listarCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
          $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorStatus($status) / $retorno->itensPorPagina);

          if($pag > $retorno->totalPaginas) {
               $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
               $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
               return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem);

          return $retorno;
     }






/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Campanha($id, $id_campanha)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNomePorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
* @param $daofactory
* @param $id
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarNomePorPK($daofactory,$nome,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNome($id, $nome)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlregulamentoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
* @param $daofactory
* @param $id
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarUrlregulamentoPorPK($daofactory,$urlRegulamento,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlregulamento($id, $urlRegulamento)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPremioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
* @param $daofactory
* @param $id
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarPremioPorPK($daofactory,$premio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePremio($id, $premio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatacomecosorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
* @param $daofactory
* @param $id
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarDatacomecosorteioPorPK($daofactory,$dataComecoSorteio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatacomecosorteio($id, $dataComecoSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatafimsorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
* @param $daofactory
* @param $id
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarDatafimsorteioPorPK($daofactory,$dataFimSorteio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatafimsorteio($id, $dataFimSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarMaxticketsPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
* @param $daofactory
* @param $id
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarMaxticketsPorPK($daofactory,$maxTickets,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateMaxtickets($id, $maxTickets)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorNome() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
*
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorNome($daofactory,$nome)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadNome($nome);
    }

/**
*
* pesquisarPorUrlregulamento() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
*
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorUrlregulamento($daofactory,$urlRegulamento)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadUrlregulamento($urlRegulamento);
    }

/**
*
* pesquisarPorPremio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
*
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorPremio($daofactory,$premio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadPremio($premio);
    }

/**
*
* pesquisarPorDatacomecosorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
*
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorDatacomecosorteio($daofactory,$dataComecoSorteio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadDatacomecosorteio($dataComecoSorteio);
    }

/**
*
* pesquisarPorDatafimsorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
*
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorDatafimsorteio($daofactory,$dataFimSorteio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadDatafimsorteio($dataFimSorteio);
    }

/**
*
* pesquisarPorMaxtickets() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
*
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorMaxtickets($daofactory,$maxTickets)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadMaxtickets($maxTickets);
    }


/**
*
* listarCampanhaSorteioUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
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

    public function listarCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
          $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

          if($pag > $retorno->totalPaginas) {
               $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
               $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
               return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

          return $retorno;
     }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaSorteioDTO
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
