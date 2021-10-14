<?php

/**
 * 
 * BacklinkService
 */

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaQrCodeService extends AppService{
    public function finalizarTicket($ticket);
    public function criarCarimbosCampanha($idcampanha);	
    public function carregarTicketLivre($ticket);
    public function carregarQRCodeLivre($qrc);
    public function validarTicket($idfiel, $ticket);
    public function validarQRCode($idfiel, $qrc);

    public function listarCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);

}


?>