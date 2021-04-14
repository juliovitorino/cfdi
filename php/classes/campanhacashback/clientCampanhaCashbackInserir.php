<?php 
// URL http://localhost/cfdi/php/classes/campanhacashback/clientCampanhaCashbackInserir.php

require_once 'CampanhaCashbackServiceImpl.php';
require_once 'CampanhaCashbackDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaCashbackDTO();

$dto->id_campanha = 1035; //7;
$dto->id_usuario = 2893; //9;
$dto->percentual = 0; //rand(1,100)/100;
$dto->dataTermino = '2019-08-24 17:30:31';
$dto->obs = Util::getLoremIpsum() . Util::getCodigo(10);

var_dump($dto);
$csi = new CampanhaCashbackServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
