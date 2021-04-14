<?php

require_once '../interfaces/DAO.php';

/**
 * EstatisticaFuncaoDAO - Extensão da interface padrão de DAO
 */
interface EstatisticaFuncaoDAO extends DAO
{
	public function updateQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
	public function updateQtdeAlternativa($tipo, $dia, $mes, $ano, $usuarioid, $projetoid, $qtde);

	public function updateQtdePK($id);

	public function loadUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
	public function loadCountFuncionalidade($tipo, $usuarioid);
	public function loadSumFuncionalidadeDiaria($tipo, $usuarioid, $dia, $mes, $ano);
	public function loadSumFuncionalidadeMensal($tipo, $usuarioid, $mes, $ano);
	public function loadSumFuncionalidadeAnual($tipo, $usuarioid, $ano);

}
?>