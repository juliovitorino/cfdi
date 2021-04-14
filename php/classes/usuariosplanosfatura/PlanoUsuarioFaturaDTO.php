<?php

// importar dependências
require_once '../dto/DTOPadrao.php';

/**
 * PlanoUsuarioFaturaDTO - Data Transfer Object
 */

class PlanoUsuarioFaturaDTO extends DTOPadrao
{
	public $id;
	public $idparent;
	public $planousuarioid;
	public $valorfatura;
	public $valordesconto;
	public $dataVencimento;
	public $dataPagamento;
	public $status;
	public $dataCadastro;
	public $dataAtualizacao;

	function __construct()	{	}

}

?>
