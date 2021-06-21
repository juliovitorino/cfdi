<?php 
// URL http://junta10.dsv/cfdi/php/classes/campanhasorteio/clientDesativarCampanhaSorteio.php
// URL http://elitefinanceira.com/cfdi/php/classes/campanhasorteio/clientDesativarCampanhaSorteio.php

require_once 'CampanhaSorteioServiceImpl.php';
require_once 'CampanhaSorteioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

//$id = 999999; // Um número inexistente
$id = 1140; // Um número inexistente
$csi = new CampanhaSorteioServiceImpl();

//var_dump($id);

// Cadastra o registro populado no DTO
$retorno = $csi->desativarCampanhaSorteio($id);
var_dump($retorno);
?>
