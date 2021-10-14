<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaQrCodeDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_QRCODES
* Camada de dados CampanhaQrCode - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2021 11:31:19
*
*/

interface CampanhaQrCodeDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaQrCodeStatus($status);
    public function countCampanhaQrCodePorStatus($status);
    public function listCampanhaQrCodePorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaQrCodePorUsuaIdStatus($usuaid, $status);
    public function listCampanhaQrCodePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxParentPK($parent,$status);

    public function countIdPorStatus($id, $status);
    public function countParentPorStatus($parent, $status);
    public function countId_CampanhaPorStatus($id_campanha, $status);
    public function countQrcodecarimboPorStatus($qrcodecarimbo, $status);
    public function countOrderPorStatus($order, $status);
    public function countTicketPorStatus($ticket, $status);
    public function countIdusuariogeradorPorStatus($idusuarioGerador, $status);

    public function loadParent($parent);
    public function loadId_Campanha($id_campanha);
    public function loadQrcodecarimbo($qrcodecarimbo);
    public function loadOrder($order);
    public function loadTicket($ticket);
    public function loadIdusuariogerador($idusuarioGerador);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateParent($id, $parent);
    public function updateId_Campanha($id, $id_campanha);
    public function updateQrcodecarimbo($id, $qrcodecarimbo);
    public function updateOrder($id, $order);
    public function updateTicket($id, $ticket);
    public function updateIdusuariogerador($id, $idusuarioGerador);

}
?>
