<?php

require_once '../interfaces/DAO.php';

/**
 * TraceDAO - Extensão da interface padrão de DAO
 */
interface TraceDAO extends DAO
{
	public function updateStatus($id, $status);

}
?>