<?php

/**
 * SessaoDTO - Data Transfer Object
 */

// importar dependĂȘncias
require_once '../dto/DTOPadrao.php';

class MensagemDTO extends DTOPadrao
{
	public $id;
	public $msgcodigo;
	public $msg;
	public $status;
	public $dataCadastro;
	public $dataAtualizacao;

	function __construct()	{	}

}

?>