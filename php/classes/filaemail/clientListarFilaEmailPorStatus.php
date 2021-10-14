<?php 

// URL http://localhost/cfdi/php/classes/filaemail/clientListarFilaEmailPorStatus.php

require_once 'FilaEmailServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new FilaEmailServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarFilaEmailPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarFilaEmailPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarFilaEmailPorStatus($status,3,2);
var_dump($retorno);


?>
