<?php 
// URL http://localhost/cfdi/php/classes/grupousuario/clientGrupoUsuarioInserir.php

require_once 'GrupoUsuarioServiceImpl.php';
require_once 'GrupoUsuarioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new GrupoUsuarioDTO();

$dto->idgrad = 1;
$dto->id_usuario = 1;

var_dump($dto);
$csi = new GrupoUsuarioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

