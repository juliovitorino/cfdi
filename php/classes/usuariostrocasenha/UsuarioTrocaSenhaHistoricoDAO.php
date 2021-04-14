<?php

require_once '../interfaces/DAO.php';

/**
 * 
 * PlanoUsuarioFaturaDAO - Extensão da interface padrão de DAO
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 18/08/2018
 */

interface UsuarioTrocaSenhaHistoricoDAO extends DAO
{
	public function loadUsuarioTrocaSenhaHistoricoPorToken($token);
	public function loadTrocaSenhaHistoricoPorUsuarioToken($usuarioid, $token);
	public function updateStatusUsuarioTrocaSenhaHistoricoPorId($id, $status);
	public function updateUsuaIDTrocaStatus($usuarioid, $statusantigo, $statusnovo);
	public function deleteUsuaIDStatus($usuarioid, $status);
	public function updateTokenStatus($utshid, $status);


}

?>