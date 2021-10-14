<?php 

// URL http://localhost/cfdi/php/classes/plano/clientListarPlanoPorStatus.php

require_once 'PlanoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new PlanoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarPlanoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarPlanoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarPlanoPorStatus($status,3,2);
var_dump($retorno);


?>
