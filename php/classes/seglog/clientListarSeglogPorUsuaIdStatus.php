<?php 

// URL http://junta10.dsv:8080/cfdi/php/classes/seglog/clientListarSeglogPorUsuaIdStatus.php

require_once 'SeglogServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new SeglogServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1000;

// Imprime a 1a pagina
$retorno = $csi->listarSeglogPorUsuaIdStatus($usuaid,$status,1,2);
echo json_encode($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarSeglogPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarSeglogPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);


?>
