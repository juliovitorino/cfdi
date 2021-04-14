<?php

/**
 * SessaoDTO - Data Transfer Object
 */

// importar dependências
require_once '../dto/DTOPadrao.php';

class VariavelDTO extends DTOPadrao
{
	public $id;
	public $variavel;
	public $descricao;
	public $conteudo;
	public $status;
	public $dataCadastro;
	public $dataAtualizacao;

	function __construct()	{	}

}

?>