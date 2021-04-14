<?php 

// URL http://localhost/cfdi/php/classes/mkdlista/clientListarMkdListaPorStatus.php

require_once 'MkdListaServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new MkdListaServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarMkdListaPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarMkdListaPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarMkdListaPorStatus($status,3,2);
var_dump($retorno);


?>
