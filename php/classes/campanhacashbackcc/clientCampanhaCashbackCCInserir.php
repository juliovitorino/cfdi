<?php 
// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientCampanhaCashbackCCInserir.php

require_once 'CampanhaCashbackCCServiceImpl.php';
require_once 'CampanhaCashbackCCDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaCashbackCCDTO();

$dto->id_cashback = 1;
$dto->id_campanha = 1;
$dto->id_usuario = 1;
$dto->id_cfdi = 1;
$dto->vlMinimo = rand(100,200)/100;
$dto->percentual = rand(1,10);
$dto->vlConsumo = rand(100,2000)/100;
$dto->vlCalcRecompensa = rand(100,2000)/100;
$dto->tipoMovimento = "C";
$dto->nfe = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->nfehash = Util::getLoremIpsum()  . Util::getCodigo(10);


var_dump($dto);
$csi = new CampanhaCashbackCCServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
