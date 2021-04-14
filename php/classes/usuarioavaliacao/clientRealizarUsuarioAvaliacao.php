<?php 
// URL http://localhost/cfdi/php/classes/usuarioavaliacao/clientRealizarUsuarioAvaliacao.php

require_once 'UsuarioAvaliacaoServiceImpl.php';
require_once 'UsuarioAvaliacaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$id_usuario = 9;
$rating = 1;

$csi = new UsuarioAvaliacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->realizarUsuarioAvaliacao($id_usuario, $rating);
var_dump($retorno);
?>
