<?php  

// importar dependencias
require_once 'VariavelBusiness.php';

/**
 * VariavelBusinessImpl - Implementação da classe de negocio
 */
class VariavelBusinessImpl implements VariavelBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function carregarPorID($daofactory, $id)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}
	public function inserir($daofactory, $dto)	{ 	}
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	public function listarTodasVariaveis($daofactory, $status)
	{
		$dao = $daofactory->getVariavelDAO($daofactory);
		return $dao->listVariavelStatus($status);
	}


}
?>
