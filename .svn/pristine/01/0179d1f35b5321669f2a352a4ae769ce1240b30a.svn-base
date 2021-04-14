<?php  

// importar dependencias
require_once 'MensagemBusiness.php';

/**
 * MensagemBusinessImpl - Implementação da classe de negocio
 */
class MensagemBusinessImpl implements MensagemBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function carregarPorID($daofactory, $id)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}
	public function inserir($daofactory, $dto)	{ 	}
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	public function listarTodasMensagens($daofactory, $status)
	{
		$dao = $daofactory->getMensagemDAO($daofactory);
		return $dao->listMensagensStatus($status);
	}


}
?>
