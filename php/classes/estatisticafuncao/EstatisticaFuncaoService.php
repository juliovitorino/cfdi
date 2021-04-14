<?php

/**
 * 
 * EstatisticaFuncaoService
 */

// importar dependências

require_once '../interfaces/AppService.php';

interface EstatisticaFuncaoService extends AppService{

	public function incrementarQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
	public function incrementarQtdePorID($id);

	public function pesquisarPorUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);

	
}


?>