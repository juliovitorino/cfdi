<?php  
// URL http://localhost/cfdi/php/classes/usuarios/clientUsuarioInserir.php
// URL http://junta10.com/php/classes/usuarios/clientUsuarioInserir.php

// importar dependencias
require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';


$dtousuario = getUsuarioFake();
$planoid = 2;

var_dump($dtousuario);
$usi = new UsuarioServiceImpl();
$ok = $usi->cadastrarNovaConta($dtousuario, $planoid);

if ($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
{
	echo "Inserido com sucesso";
} else {
	echo "Algum erro acontenceu";
}
exit(0);


function getUsuarioFake()
{
	$date = new DateTime();
	$ts = $date->getTimestamp();

	$dto = new UsuarioDTO();
//	$dto->email = $ts . '@garibadi.com.br';
	$dto->email = 'contato@junta10.com';
	$dto->pwd = '1';
	$dto->apelido = 'Julio ' . $ts . ' Vitorino';
	$dto->tipoConta = 'C';

	return $dto;
}


?>