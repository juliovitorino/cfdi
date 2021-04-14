<?php

require_once '../interfaces/DAO.php';

/**
*
* CartaoPedidoDAO - Interface dos métodos de acesso aos dados da tabela CARTAO_PEDIDO
* Camada de dados CartaoPedido - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2019 14:08:07
*
*/

interface CartaoPedidoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCartaoPedidoStatus($status);
    public function countCartaoPedidoPorStatus($status);
    public function listCartaoPedidoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCartaoPedidoPorUsuaIdStatus($usuaid, $status);
    public function listCartaoPedidoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_CampanhaPK($id_campanha,$status);

    public function loadId_Campanha($id_campanha);
    public function loadHashtransacao($hashTransacao);
    public function loadQtde($qtde);
    public function loadSelos($selos);
    public function loadVlrpedido($vlrPedido);
    public function loadDataautorizacao($dataAutorizacao);
    public function loadDatapgto($dataPgto);
    public function loadVlrpgto($vlrPgto);
    public function loadHashgtway($hashGtway);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Campanha($id, $id_campanha);
    public function updateHashtransacao($id, $hashTransacao);
    public function updateQtde($id, $qtde);
    public function updateSelos($id, $selos);
    public function updateVlrpedido($id, $vlrPedido);
    public function updateDataautorizacao($id, $dataAutorizacao);
    public function updateDatapgto($id, $dataPgto);
    public function updateVlrpgto($id, $vlrPgto);
    public function updateHashgtway($id, $hashGtway);

}
?>

