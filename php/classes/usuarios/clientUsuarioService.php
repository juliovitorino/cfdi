<?php

require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';

$dto = new UsuarioDTO();
$dto->id = 100;

$idx = $_GET['idx'];

switch ($idx) {
	case '1':
		$servico = new UsuarioServiceImpl();
		$retorno = $servico->pesquisar($dto);

		echo $retorno->id;
		echo "<br>";
		echo $retorno->email;
		echo "<br>";
		echo $retorno->apelido;
		echo "<br>";
		echo $retorno->tipoConta;
		echo "<br>";
		echo $retorno->pwd;
		echo "<br>";
		echo $retorno->status;
		echo "<br>";
		echo $retorno->dataCadastro;
		echo "<br>";
		echo $retorno->dataAtualizacao;
	break;
	
	case '2':
		$servico = new UsuarioServiceImpl();
		$retorno = $servico->buscarProjetoEspecifico(1,2);
		if (is_null($retorno)){
			echo "NADA ENCONTRADO";
		} else {
			echo $retorno->projeto;
			echo "<br>";
			echo $retorno->status;
			echo "<br>";
			echo $retorno->dataCadastro;
			echo "<br>";
			echo $retorno->dataAtualizacao;
		}

	break;
	
	default:
		# code...
		break;
}



?>