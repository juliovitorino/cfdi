<?php 
// URL http://localhost/cfdi/php/classes/usuarioautorizador/clientUsuarioAutorizadorInserir.php

require_once 'UsuarioAutorizadorServiceImpl.php';
require_once 'UsuarioAutorizadorDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioAutorizadorDTO();

$dto->id_usuario = 2893;
$dto->id_autorizador = 15;
$dto->id_campanha = 1000;
$dto->tipo = 'T';
$dto->permissao = '00';
$dto->dataInicio = '2019-08-24 17:30:31';
$dto->dataTermino = '2019-08-24 19:30:31';

var_dump($dto);
$csi = new UsuarioAutorizadorServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
