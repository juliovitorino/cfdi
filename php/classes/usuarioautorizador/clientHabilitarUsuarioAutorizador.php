<?php 
// URL http://JUNTA10.DSV:8080/cfdi/php/classes/usuarioautorizador/clientHabilitarUsuarioAutorizador.php

require_once 'UsuarioAutorizadorServiceImpl.php';
require_once 'UsuarioAutorizadorDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioAutorizadorDTO();

$dto->id = 3; //2387;//27; // qual é o id - função já dependente do ID para usar os itens abaixo para checagem
$dto->id_usuario = 1016; // quem vai ser autorizado
$dto->id_autorizador = 1000; // quem é o dono da campanha
$dto->id_campanha = 1000; // qual é a campanha

//var_dump($dto);
$csi = new UsuarioAutorizadorServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->habilitarUsuarioAutorizador($dto);
var_dump($retorno);
?>
