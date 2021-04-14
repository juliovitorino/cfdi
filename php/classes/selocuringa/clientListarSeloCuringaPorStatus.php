<?php 

// URL http://localhost/cfdi/php/classes/selocuringa/clientListarSeloCuringaPorStatus.php

require_once 'seloCuringaServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new SeloCuringaServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarSeloCuringaPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarSeloCuringaPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarSeloCuringaPorStatus($status,3,2);
var_dump($retorno);


?>
