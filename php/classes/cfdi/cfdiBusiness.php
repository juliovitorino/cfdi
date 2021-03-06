<?php

/**
 * 
 * BacklinkBusiness
 */

// importar dependĂȘncias
require_once '../interfaces/BusinessObject.php';

interface CfdiBusiness extends BusinessObject
{
	public function atualizarStatus($daofactory, $id, $status);
	public function carimbarQrCodeCfdi($daofactory, $id_campanha, $id_fiel, $qrcode);
	public function atualizarUsuarioGeradorQRCode($daofactory, $carimbo);
	public function carregarPorCarimbo($daofactory, $carimbo);
	public function atualizarUsuaIdPorCarimbo($daofactory, $carimbo, $usuaid);

}

?>
