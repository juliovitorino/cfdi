<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackresgatepix/clientListarCampanhaCashbackResgatePixPorStatus.php

require_once 'CampanhaCashbackResgatePixServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaCashbackResgatePixServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarCampanhaCashbackResgatePixPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarCampanhaCashbackResgatePixPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCampanhaCashbackResgatePixPorStatus($status,3,2);
var_dump($retorno);


?>
