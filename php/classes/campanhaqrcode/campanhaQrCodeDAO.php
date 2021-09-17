<?php

require_once '../interfaces/DAO.php';

/**
 * CampanhaQrCodeDAO - Extensão da interface padrão de DAO
 */
interface CampanhaQrCodeDAO extends DAO
{
    public function updateStatusPorTicket($ticket, $status);	
    public function loadTicketPorStatus($ticket, $status);
    public function loadQRCodePorStatus($qrc, $status);
    public function updateStatusPorCarimbo($carimboqr, $status);
	public function loadParent($id);
    public function updateUsuarioGeradorQRCode($caqrid, $idusuario);
    public function loadQRCode($qrcode);

    public function countCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status);
    public function listCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status, $pag, $qtde, $coluna, $ordem);

}
?>