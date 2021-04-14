<?php

require_once '../interfaces/DAO.php';

/**
 * SessaoDAO - Extensão da interface padrão de DAO
 */
interface SessaoDAO extends DAO
{
		public function loadToken($token);
}

?>