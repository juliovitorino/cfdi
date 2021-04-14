<?php 

// URL http://localhost/cfdi/php/classes/campanhacashback/clientListarCampanhaCashbackPorStatus.php

require_once 'campanhaCashbackServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaCashbackServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

$retorno = $csi->listarCampanhaCashbackPorStatus($status,1,2);
var_dump($retorno);

$retorno = $csi->listarCampanhaCashbackPorStatus($status,2,2);
var_dump($retorno);

$retorno = $csi->listarCampanhaCashbackPorStatus($status,3,2);
var_dump($retorno);


?>
