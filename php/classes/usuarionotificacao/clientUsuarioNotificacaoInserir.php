<?php 
// URL http://localhost/cfdi/php/classes/usuarionotificacao/clientUsuarioNotificacaoInserir.php

require_once 'UsuarioNotificacaoServiceImpl.php';
require_once 'UsuarioNotificacaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioNotificacaoDTO();

$dto->id_usuario = 4;
$dto->notificacao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->tipo = "00";
$dto->json = "{}";

var_dump($dto);
$csi = new UsuarioNotificacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
echo "<br>";
echo json_encode($retorno);
?>
