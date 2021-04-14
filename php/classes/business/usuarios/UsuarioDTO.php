<?php

require_once '../../dto/DTOPadrao.php';

/**
 * UsuarioDTO - Data Transfer Object
 */
class UsuarioDTO extends DTOPadrao
{
	public $id;
	public $email;
	public $pwd;
	public $apelido;
	public $tipoConta;
	public $status;
	public $lst_projetos = array();

	function __construct()	{	}

}

?>