<?php

/**
 * 
 * UsuariosBusiness
 */

require_once '../../interfaces/BusinessObject.php';
require_once '../../daofactory/DAOFactory.php';
require_once 'UsuarioDAO.php';

class UsuarioBusiness implements BusinessObject
{
	
	function __construct()
	{
		# code...
	}

	// Carrega um objeto
	public function carregar($dto)
	{
		$daofactory = DAOFactory::getDAOFactory();
		$dao = $daofactory->getUsuarioDAO($daofactory);
		return $dao->load($dto);

	}
}

?>