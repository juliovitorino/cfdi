<?php

/**
 * 
 * TraceBusiness
 */

// importar dependĂȘncias
require_once '../interfaces/BusinessObject.php';

interface TraceBusiness extends BusinessObject
{
	public function atualizarStatus($daofactory, $id, $status);
}

?>
