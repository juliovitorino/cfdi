<?php 
// URL http://localhost/cfdi/php/classes/campanhatopdez/clientCampanhaTopDezInserir.php

require_once 'CampanhaTopDezServiceImpl.php';
require_once 'CampanhaTopDezDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaTopDezDTO();
$dto->id_campanha = 1;
$dto->id_usuario = 1;

$csi = new CampanhaTopDezServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
























































































































































