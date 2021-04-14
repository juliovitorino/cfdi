<?php 
// URL http://localhost/cfdi/php/classes/usuarioautorizador/clientHabilitarUsuarioAutorizador.php

require_once 'UsuarioAutorizadorServiceImpl.php';
require_once 'UsuarioAutorizadorDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioAutorizadorDTO();

$dto->id = 27; //2387;//27; // qual é o id - função já dependente do ID para usar os itens abaixo para checagem
$dto->id_usuario = 4; // quem vai ser autorizado
$dto->id_autorizador = 9; // quem é o dono da campanha
$dto->id_campanha = 7; // qual é a campanha

var_dump($dto);
$csi = new UsuarioAutorizadorServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->habilitarUsuarioAutorizador($dto);
var_dump($retorno);
?>
