<?php

require_once '../interfaces/DAO.php';

/**
 * ProjetoItensDAO - Extensão da interface padrão de DAO
 */
interface ProjetoItensDAO extends DAO
{
	public function listItens($idProjeto);
		
}
?>