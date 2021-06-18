<?php 
// URL http://localhost/cfdi/php/classes/versao/clientVersaoInserir.php

require_once 'VersaoServiceImpl.php';
require_once 'VersaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new VersaoDTO();

$dto->id = 1;
$dto->versao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new VersaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
























































































































































