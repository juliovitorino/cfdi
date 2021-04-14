<?php 
// URL http://localhost/cfdi/php/classes/usuarioversao/clientUsuarioVersaoInserir.php

require_once 'UsuarioVersaoServiceImpl.php';
require_once 'UsuarioVersaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioVersaoDTO();

$dto->id = 1;
$dto->id_versao = 1;
$dto->id_usuario = 1;

var_dump($dto);
$csi = new UsuarioVersaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
