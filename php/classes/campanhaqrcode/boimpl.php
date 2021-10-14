<?php 

// importar dependencias
require_once 'CampanhaQrCodeBusiness.php';
require_once 'CampanhaQrCodeConstantes.php';
require_once 'CampanhaQrCodeHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';
require_once '../dto/DTOContagem.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* CampanhaQrCodeBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaQrCodeBusiness
* Camada de negócio CampanhaQrCode - camada responsável pela lógica de negócios de CampanhaQrCode do sistema. 
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
* @since 17/09/2021 11:31:19
*
*/


class CampanhaQrCodeBusinessImpl implements CampanhaQrCodeBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_QRCODES::CAQR_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_QRCODES sem critério de paginação
* @param $daofactory
* @return List<CampanhaQrCodeDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoParentPorStatus() - Carrega apenas um registro com base no parent  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaQrCodeDTO
*/ 
    public function pesquisarMaxPKAtivoParentPorStatus($daofactory, $parent,$status)
    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $maxid = $dao->loadMaxParentPK($parent,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaQrCodeDTO->id
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


        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaQrCodeDTO->id
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
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

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
* @return List<CampanhaQrCodeDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_QRCODES usando a Primary Key CAQR_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaQrCodeDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_QRCODES usando a Primary Key CAQR_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaQrCodeDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

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
* inserirCampanhaQrCode() - inserir um registro com base no CampanhaQrCodeDTO. Alguns atributos dentro do DTO
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
public function inserirCampanhaQrCode($daofactory, $dto)
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
* inserir() - inserir um registro com base no CampanhaQrCodeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaQrCodeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaQrCodeConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaQrCodeConstantes::LEN_ID, CampanhaQrCodeConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->parent com tamanho CampanhaQrCodeConstantes::LEN_PARENT
    $ok = $this->validarTamanhoCampo($dto->parent, CampanhaQrCodeConstantes::LEN_PARENT, CampanhaQrCodeConstantes::DESC_PARENT);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho CampanhaQrCodeConstantes::LEN_ID_CAMPANHA
    $ok = $this->validarTamanhoCampo($dto->id_campanha, CampanhaQrCodeConstantes::LEN_ID_CAMPANHA, CampanhaQrCodeConstantes::DESC_ID_CAMPANHA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->qrcodecarimbo com tamanho CampanhaQrCodeConstantes::LEN_QRCODECARIMBO
    $ok = $this->validarTamanhoCampo($dto->qrcodecarimbo, CampanhaQrCodeConstantes::LEN_QRCODECARIMBO, CampanhaQrCodeConstantes::DESC_QRCODECARIMBO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->order com tamanho CampanhaQrCodeConstantes::LEN_ORDER
    $ok = $this->validarTamanhoCampo($dto->order, CampanhaQrCodeConstantes::LEN_ORDER, CampanhaQrCodeConstantes::DESC_ORDER);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->ticket com tamanho CampanhaQrCodeConstantes::LEN_TICKET
    $ok = $this->validarTamanhoCampo($dto->ticket, CampanhaQrCodeConstantes::LEN_TICKET, CampanhaQrCodeConstantes::DESC_TICKET);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idusuarioGerador com tamanho CampanhaQrCodeConstantes::LEN_IDUSUARIOGERADOR
    $ok = $this->validarTamanhoCampo($dto->idusuarioGerador, CampanhaQrCodeConstantes::LEN_IDUSUARIOGERADOR, CampanhaQrCodeConstantes::DESC_IDUSUARIOGERADOR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho CampanhaQrCodeConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaQrCodeConstantes::LEN_STATUS, CampanhaQrCodeConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaQrCodeConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaQrCodeConstantes::LEN_DATACADASTRO, CampanhaQrCodeConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaQrCodeConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaQrCodeConstantes::LEN_DATAATUALIZACAO, CampanhaQrCodeConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

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
* listarCampanhaQrCodePorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
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

    public function listarCampanhaQrCodePorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaQrCodePorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaQrCodePorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
*
* contarIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $id
* @param $status
*/

    public function contarIdPorStatus($daofactory, $id, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countIdPorStatus($id, $status);
        
        return $retorno;
    }

/**
*
* contarParentPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $parent
* @param $status
*/

    public function contarParentPorStatus($daofactory, $parent, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countParentPorStatus($parent, $status);
        
        return $retorno;
    }

/**
*
* contarId_CampanhaPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $id_campanha
* @param $status
*/

    public function contarId_CampanhaPorStatus($daofactory, $id_campanha, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countId_CampanhaPorStatus($id_campanha, $status);
        
        return $retorno;
    }

/**
*
* contarQrcodecarimboPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $qrcodecarimbo
* @param $status
*/

    public function contarQrcodecarimboPorStatus($daofactory, $qrcodecarimbo, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countQrcodecarimboPorStatus($qrcodecarimbo, $status);
        
        return $retorno;
    }

/**
*
* contarOrderPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $order
* @param $status
*/

    public function contarOrderPorStatus($daofactory, $order, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countOrderPorStatus($order, $status);
        
        return $retorno;
    }

/**
*
* contarTicketPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $ticket
* @param $status
*/

    public function contarTicketPorStatus($daofactory, $ticket, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countTicketPorStatus($ticket, $status);
        
        return $retorno;
    }

/**
*
* contarIdusuariogeradorPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar uma contagem dos registros
*
* @param $daofactory
* @param $idusuarioGerador
* @param $status
*/

    public function contarIdusuariogeradorPorStatus($daofactory, $idusuarioGerador, $status)
    {
        $retorno = new DTOContagem();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->contador = $dao->countIdusuariogeradorPorStatus($idusuarioGerador, $status);
        
        return $retorno;
    }

/**
*
* atualizarParentPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID da qrcode parent diretamente na tabela CAMPANHA_QRCODES campo CAQR_ID_PARENT
* @param $daofactory
* @param $id
* @param $parent
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarParentPorPK($daofactory,$parent,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateParent($id, $parent)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_QRCODES campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

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
* atualizarQrcodecarimboPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de qrcode diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_QRCODE
* @param $daofactory
* @param $id
* @param $qrcodecarimbo
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarQrcodecarimboPorPK($daofactory,$qrcodecarimbo,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateQrcodecarimbo($id, $qrcodecarimbo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarOrderPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de Ordenamento diretamente na tabela CAMPANHA_QRCODES campo CAQR_NU_ORDER
* @param $daofactory
* @param $id
* @param $order
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarOrderPorPK($daofactory,$order,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateOrder($id, $order)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTicketPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de Ticket Reduzido diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_TICKET
* @param $daofactory
* @param $id
* @param $ticket
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarTicketPorPK($daofactory,$ticket,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTicket($id, $ticket)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuariogeradorPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID do usuário gerador diretamente na tabela CAMPANHA_QRCODES campo USUA_ID_GERADOR
* @param $daofactory
* @param $id
* @param $idusuarioGerador
* @return CampanhaQrCodeDTO
*
* 
*/
    public function atualizarIdusuariogeradorPorPK($daofactory,$idusuarioGerador,$id)
    {
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuariogerador($id, $idusuarioGerador)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorParent() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID da qrcode parent diretamente na tabela CAMPANHA_QRCODES campo CAQR_ID_PARENT
*
* @param $parent
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorParent($daofactory,$parent)
    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadParent($parent);
    }

/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_QRCODES campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)

    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorQrcodecarimbo() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de qrcode diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_QRCODE
*
* @param $qrcodecarimbo
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorQrcodecarimbo($daofactory,$qrcodecarimbo)

    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadQrcodecarimbo($qrcodecarimbo);
    }

/**
*
* pesquisarPorOrder() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de Ordenamento diretamente na tabela CAMPANHA_QRCODES campo CAQR_NU_ORDER
*
* @param $order
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorOrder($daofactory,$order)

    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadOrder($order);
    }

/**
*
* pesquisarPorTicket() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de Ticket Reduzido diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_TICKET
*
* @param $ticket
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorTicket($daofactory,$ticket)

    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadTicket($ticket);
    }

/**
*
* pesquisarPorIdusuariogerador() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID do usuário gerador diretamente na tabela CAMPANHA_QRCODES campo USUA_ID_GERADOR
*
* @param $idusuarioGerador
* @return CampanhaQrCodeDTO
*
* 
*/
    public function pesquisarPorIdusuariogerador($daofactory,$idusuarioGerador)

    { 
        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        return $dao->loadIdusuariogerador($idusuarioGerador);
    }

/**
*
* listarCampanhaQrCodeUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
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

    public function listarCampanhaQrCodePorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaQrCodePorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaQrCodePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaQrCodeDTO
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
