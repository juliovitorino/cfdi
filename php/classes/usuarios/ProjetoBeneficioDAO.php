<?php

require_once '../interfaces/DAO.php';

/**
 * ProjetoBeneficioDAO - Extensão da interface padrão de DAO
 */
interface ProjetoBeneficioDAO extends DAO
{
	public function listBeneficios($idProjeto);
		
}
?>