<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientListarCampanhaCashbackCCPorStatus.php

require_once 'campanhaCashbackCCServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaCashbackCCServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

$retorno = $csi->listarCampanhaCashbackCCPorStatus($status,1,2);
var_dump($retorno);

$retorno = $csi->listarCampanhaCashbackCCPorStatus($status,2,2);
var_dump($retorno);

$retorno = $csi->listarCampanhaCashbackCCPorStatus($status,3,2);
var_dump($retorno);


?>
