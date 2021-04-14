<?php 
// URL http://localhost/cfdi/php/classes/usuarioversao/clientVerificarVersaoSistema.php

require_once 'UsuarioVersaoServiceImpl.php';
require_once 'UsuarioVersaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$versao = "1.0.0.20191006.1740"; //"1.0.0.2091006.1705"; //"5t7328652347562";
$id_usuario = 1;

$csi = new UsuarioVersaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->verificarVersaoSistema($id_usuario, $versao);
var_dump($retorno);
?>
