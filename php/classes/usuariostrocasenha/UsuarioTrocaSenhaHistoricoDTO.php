<?php

// importar dependências
require_once '../dto/DTOPadrao.php';

/**
 * PlanoUsuarioFaturaDTO - Data Transfer Object
 */

class UsuarioTrocaSenhaHistoricoDTO extends DTOPadrao
{
	public $id;
	public $usuarioid;
	public $token;
	public $status;
	public $dataCadastro;
	public $dataAtualizacao;

	function __construct()	{	}

}

?>
