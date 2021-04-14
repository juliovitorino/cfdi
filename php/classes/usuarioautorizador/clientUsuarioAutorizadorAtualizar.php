<?php 
// URL http://localhost/cfdi/php/classes/usuarioautorizador/clientUsuarioAutorizadorAtualizar.php

require_once 'UsuarioAutorizadorServiceImpl.php';
require_once 'UsuarioAutorizadorDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioAutorizadorDTO();

$dto->id = 39;
$dto->id_usuario = 999;
$dto->id_autorizador = 22;
$dto->id_campanha = 4;
$dto->tipo = 'T';
$dto->permissao = '00';
$dto->dataInicio = Util::getNow();
$dto->dataTermino = Util::getNow();

var_dump($dto);
$csi = new UsuarioAutorizadorServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->atualizar($dto);
var_dump($retorno);
?>
