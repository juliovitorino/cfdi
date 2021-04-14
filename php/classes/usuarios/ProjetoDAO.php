<?php

require_once '../interfaces/DAO.php';

/**
 * ProjetoDAO - Extensão da interface padrão de DAO
 */
interface ProjetoDAO extends DAO
{
	public function listProjetosArray($idUsuario);
	public function loadProjetoEspecifico($idUsuario, $idProjeto);
	public function loadProjetoRecente($idUsuario);
		
}
?>