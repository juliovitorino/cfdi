<?php

require_once '../interfaces/DAO.php';

/**
 * 
 * PlanoUsuarioFaturaDAO - Extensão da interface padrão de DAO
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 18/08/2018
 */

interface PlanoUsuarioFaturaDAO extends DAO
{
	public function loadPlanoUsuarioFaturaPorStatus($usuarioid, $status);
	public function updateStatusPlanoUsuarioFaturaPorId($plufid, $status);
	public function loadPlanoUsuarioFaturaMaisRecente($plusid);
}

?>