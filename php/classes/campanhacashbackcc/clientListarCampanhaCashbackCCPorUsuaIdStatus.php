<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientListarCampanhaCashbackCCPorUsuaIdStatus.php

require_once 'CampanhaCashbackCCServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaCashbackCCServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1;

// Imprime a 1a pagina
$retorno = $csi->listarCampanhaCashbackCCPorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarCampanhaCashbackCCPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCampanhaCashbackCCPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);


?>
