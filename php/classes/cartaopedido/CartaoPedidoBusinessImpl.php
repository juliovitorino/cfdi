<?php 

// importar dependencias
require_once 'CartaoPedidoBusiness.php';
require_once 'CartaoPedidoFullDTO.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../plano/PlanoBusinessImpl.php';

/**
*
* CartaoPedidoBusinessImpl - Classe de implementação dos métodos de negócio para a interface CartaoPedidoBusiness
* Camada de negócio CartaoPedido - camada responsável pela lógica de negócios de CartaoPedido do sistema. 
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
* @since 17/09/2019 14:08:07
*
*/


class CartaoPedidoBusinessImpl implements CartaoPedidoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CARTAO_PEDIDO::CAPE_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CARTAO_PEDIDO sem critério de paginação
* @param $daofactory
* @return List<CartaoPedidoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
*
* cadastrarPedido() - Cadastrar uma solicitação de pedido de aumento de cartões em campanha
*
* @param $idplano
* @param $id_campanha
*
*/
    public function cadastrarPedido($daofactory, $idplano, $capedtoin)
    {
        $capefulldto = new CartaoPedidoFullDTO();
        $capefulldto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $capefulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($capefulldto->msgcode);

        $planbo = new PlanoBusinessImpl();
        $plandto = $planbo->carregarPorID($daofactory, $idplano);

        // Verifica se a campanha existe pra pegar algumas informações

        // Verificar se o plano pra pegar algumas informações
        //...
        $capefulldto->plano = $plandto;

        // Copiar as informações necessárias para o DTO de criação do pedido
        $capedto = new CartaoPedidoDTO();
        $capedto->id_campanha = $capedtoin->id_campanha;
        $capedto->descpedido = "pegar do plano";
        $capedto->hashTransacao = sha1( Util::getCodigo(2048)) ;
        $capedto->qtde = $capedtoin->qtde;
        $capedto->selos = 10; // pegar a quantidade de selos registrada na campanha
        $capedto->vlrPedido = 12.50; // Pegar o valor do plano
        
        // Solicitar a gravação do pedido
        $capedao = $daofactory->getCartaoPedidoDAO($daofactory);

        if(! $capedao->insert($capedto)){
            $capefulldto->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
            $capefulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($capefulldto->msgcode);
            return $capefulldto;
        }

        $capefulldto->cartaopedido = $capedto;

        // Enviar link para pagamento


        // Retorno
        return $capefulldto;

    }

/**
* PesquisarMaxPKAtivoId_CampanhaPorStatus() - Carrega apenas um registro com base no id_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CartaoPedidoDTO
*/ 
    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status)
    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        $maxid = $dao->loadMaxId_CampanhaPK($id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CartaoPedidoDTO->id
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


        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CartaoPedidoDTO->id
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
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

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
* @return List<CartaoPedidoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CARTAO_PEDIDO usando a Primary Key CAPE_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CartaoPedidoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CARTAO_PEDIDO usando a Primary Key CAPE_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CartaoPedidoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

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
* inserir() - inserir um registro com base no CartaoPedidoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CartaoPedidoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID do cartão pedido');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_campanha, 11, 'ID da campanha');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->hashTransacao com tamanho 100
    $ok = $this->validarTamanhoCampo($dto->hashTransacao, 100, 'Hash de transação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->qtde com tamanho 5
    $ok = $this->validarTamanhoCampo($dto->qtde, 5, 'Quantidade');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->selos com tamanho 2
    $ok = $this->validarTamanhoCampo($dto->selos, 2, 'Número de Selos');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlrPedido com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlrPedido, 10, 'Valor do Pedido');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAutorizacao com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataAutorizacao, 19, 'Data de Autorização Gateway');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataPgto com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataPgto, 19, 'Data do pagamento');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlrPgto com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlrPgto, 10, 'Valor Efetivo Pago');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->hashGtway com tamanho 100
    $ok = $this->validarTamanhoCampo($dto->hashGtway, 100, 'Hash de transação do Gateway');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCartaoPedidoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCartaoPedidoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CartaoPedidoDAO de forma geral
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

    public function listarCartaoPedidoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCartaoPedidoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCartaoPedidoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CARTAO_PEDIDO campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

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
* atualizarHashtransacaoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Hash de transação diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH
* @param $daofactory
* @param $id
* @param $hashTransacao
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarHashtransacaoPorPK($daofactory,$hashTransacao,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateHashtransacao($id, $hashTransacao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarQtdePorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Quantidade diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_QTDE
* @param $daofactory
* @param $id
* @param $qtde
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarQtdePorPK($daofactory,$qtde,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateQtde($id, $qtde)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarSelosPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Número de Selos diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_SELOS
* @param $daofactory
* @param $id
* @param $selos
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarSelosPorPK($daofactory,$selos,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateSelos($id, $selos)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlrpedidoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Valor do Pedido diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PEDIDO
* @param $daofactory
* @param $id
* @param $vlrPedido
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarVlrpedidoPorPK($daofactory,$vlrPedido,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlrpedido($id, $vlrPedido)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDataautorizacaoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Data de Autorização Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_AUTORIZACAO
* @param $daofactory
* @param $id
* @param $dataAutorizacao
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarDataautorizacaoPorPK($daofactory,$dataAutorizacao,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDataautorizacao($id, $dataAutorizacao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatapgtoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Data do pagamento diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_PGTO
* @param $daofactory
* @param $id
* @param $dataPgto
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarDatapgtoPorPK($daofactory,$dataPgto,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatapgto($id, $dataPgto)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlrpgtoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Valor Efetivo Pago diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PGTO
* @param $daofactory
* @param $id
* @param $vlrPgto
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarVlrpgtoPorPK($daofactory,$vlrPgto,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlrpgto($id, $vlrPgto)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarHashgtwayPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Hash de transação do Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH_GATEWAY
* @param $daofactory
* @param $id
* @param $hashGtway
* @return CartaoPedidoDTO
*
* 
*/
    public function atualizarHashgtwayPorPK($daofactory,$hashGtway,$id)
    {
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateHashgtway($id, $hashGtway)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CARTAO_PEDIDO campo CAMP_ID
*
* @param $id_campanha
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorHashtransacao() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Hash de transação diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH
*
* @param $hashTransacao
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorHashtransacao($daofactory,$hashTransacao)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadHashtransacao($hashTransacao);
    }

/**
*
* pesquisarPorQtde() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Quantidade diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_QTDE
*
* @param $qtde
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorQtde($daofactory,$qtde)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadQtde($qtde);
    }

/**
*
* pesquisarPorSelos() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Número de Selos diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_SELOS
*
* @param $selos
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorSelos($daofactory,$selos)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadSelos($selos);
    }

/**
*
* pesquisarPorVlrpedido() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Valor do Pedido diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PEDIDO
*
* @param $vlrPedido
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorVlrpedido($daofactory,$vlrPedido)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadVlrpedido($vlrPedido);
    }

/**
*
* pesquisarPorDataautorizacao() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Data de Autorização Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_AUTORIZACAO
*
* @param $dataAutorizacao
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorDataautorizacao($daofactory,$dataAutorizacao)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadDataautorizacao($dataAutorizacao);
    }

/**
*
* pesquisarPorDatapgto() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Data do pagamento diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_PGTO
*
* @param $dataPgto
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorDatapgto($daofactory,$dataPgto)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadDatapgto($dataPgto);
    }

/**
*
* pesquisarPorVlrpgto() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Valor Efetivo Pago diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PGTO
*
* @param $vlrPgto
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorVlrpgto($daofactory,$vlrPgto)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadVlrpgto($vlrPgto);
    }

/**
*
* pesquisarPorHashgtway() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Hash de transação do Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH_GATEWAY
*
* @param $hashGtway
* @return CartaoPedidoDTO
*
* 
*/
    public function pesquisarPorHashgtway($daofactory,$hashGtway)

    { 
        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        return $dao->loadHashgtway($hashGtway);
    }


/**
*
* listarCartaoPedidoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CartaoPedidoDAO de forma geral
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

    public function listarCartaoPedidoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCartaoPedidoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCartaoPedidoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCartaoPedidoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CartaoPedidoDTO
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
