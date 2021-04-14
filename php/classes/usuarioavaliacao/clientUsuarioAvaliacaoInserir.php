<?php 
// URL http://localhost/cfdi/php/classes/usuarioavaliacao/clientUsuarioAvaliacaoInserir.php

require_once 'UsuarioAvaliacaoServiceImpl.php';
require_once 'UsuarioAvaliacaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioAvaliacaoDTO();

$dto->id_usuario = 9;

var_dump($dto);
$csi = new UsuarioAvaliacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
