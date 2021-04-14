<?php

/**
 * DAOFactory - Fabrica de Objetos DAO
 *
 * @author Julio Vitorino
 * @since 25/07/2018
 */

require_once '../usuarios/JsonUsuarioDAO.php';

class JsonDAOFactory
{

	/* anula construtor */
	public function __construct()
	{
		# code...
	}
	
	/**
	 * Retorna um sequencia
	 * @return long
	 */
	public function getNextSequence($daofactory, $sequence) 
	{
		return 1;
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return JsonUsuarioDAO
	 */
	public function getUsuarioDAO($daofactory) 
	{
		return new JsonUsuarioDAO($daofactory);
	}



}
?>
