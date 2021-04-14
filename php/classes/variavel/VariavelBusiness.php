<?php

/**
 * 
 * VariavelBusiness
 */

require_once '../interfaces/BusinessObject.php';

interface VariavelBusiness extends BusinessObject
{
	public function listarTodasVariaveis($daofactory, $status);

}

?>