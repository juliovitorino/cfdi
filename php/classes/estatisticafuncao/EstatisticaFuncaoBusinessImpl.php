<?php  

// importar dependencias
require_once 'EstatisticaFuncaoBusiness.php';

/**
 * EstatisticaFuncaoBusinessImpl - Implementação da classe de negocio
 */
class EstatisticaFuncaoBusinessImpl implements EstatisticaFuncaoBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}
	public function listarPagina($daofactory, $pag, $qtde)	{	}


	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->loadPK($id);

	}

	public function inserir($daofactory, $dto)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->insert($dto);

	}

	public function pesquisarPorUIX($daofactory, $tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->loadUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
	}

	public function incrementarQtdePorID($daofactory, $id)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->updateQtdePK($id);
	}

	public function incrementarQtdeAlternativa($daofactory, $tipo, $dia, $mes, $ano, $usuarioid, $projetoid, $qtde)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->updateQtdeAlternativa($tipo, $dia, $mes, $ano, $usuarioid, $projetoid, $qtde);
	}

	public function incrementarQtde($daofactory, $tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{ 
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		return $dao->updateQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
	}

}
?>
