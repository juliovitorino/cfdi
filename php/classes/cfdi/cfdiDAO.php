<?php

require_once '../interfaces/DAO.php';

/**
 * cfdiDAO - Extensão da interface padrão de DAO
 */
interface CfdiDAO extends DAO
{
	public function updateStatus($id, $status);
	public function loadCarimbo($carimbo);
	public function updateUsuarioGeradorQRCode($carimbo, $idusuarioGerador);
}
?>