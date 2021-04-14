<?php 
// URL http://localhost/cfdi/php/classes/selocuringa/clientSeloCuringaInserir.php

require_once 'seloCuringaServiceImpl.php';
require_once 'seloCuringaDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new SeloCuringaDTO();

$dto->id_usuario = 999; //rand(1,1000);
$dto->id_campanha = 1001;
$dto->id_cartao = 1006;
$dto->id_autorizador = 666;
$dto->qrcode = sha1(Util::getLoremIpsum() . Util::getCodigo(10));

var_dump($dto);
$csi = new SeloCuringaServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>

