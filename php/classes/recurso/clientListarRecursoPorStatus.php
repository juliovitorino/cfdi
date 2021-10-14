<?php 

// URL http://localhost/cfdi/php/classes/recurso/clientListarRecursoPorStatus.php

require_once 'RecursoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new RecursoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarRecursoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarRecursoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarRecursoPorStatus($status,3,2);
var_dump($retorno);


?>
