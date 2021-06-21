<?php 
// URL http://junta10.dsv/cfdi/php/classes/campanhasorteio/clientCampanhaSorteioExcluir.php
// URL http://elitefinanceira.com/cfdi/php/classes/campanhasorteio/clientCampanhaSorteioExcluir.php

require_once 'CampanhaSorteioServiceImpl.php';
require_once 'CampanhaSorteioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$id = 1153;

$csi = new CampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->apagarCampanhaSorteio($id);
var_dump($retorno);
?>
