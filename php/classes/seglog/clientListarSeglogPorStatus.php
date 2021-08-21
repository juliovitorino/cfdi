<?php 

// URL http://localhost/cfdi/php/classes/seglog/clientListarSeglogPorStatus.php

require_once 'SeglogServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new SeglogServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarSeglogPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarSeglogPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarSeglogPorStatus($status,3,2);
var_dump($retorno);


?>
