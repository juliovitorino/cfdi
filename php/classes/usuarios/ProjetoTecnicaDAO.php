<?php

require_once '../interfaces/DAO.php';

/**
 * ProjetoTecnicaDAO - Extensão da interface padrão de DAO
 */
interface ProjetoTecnicaDAO extends DAO
{
	public function listTecnicas($idProjeto);
		
}
?>