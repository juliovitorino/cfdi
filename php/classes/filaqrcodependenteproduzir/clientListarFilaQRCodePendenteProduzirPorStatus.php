<?php 

// URL http://localhost/cfdi/php/classes/filaqrcodependenteproduzir/clientListarFilaQRCodePendenteProduzirPorStatus.php

require_once 'FilaQRCodePendenteProduzirServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new FilaQRCodePendenteProduzirServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarFilaQRCodePendenteProduzirPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarFilaQRCodePendenteProduzirPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarFilaQRCodePendenteProduzirPorStatus($status,3,2);
var_dump($retorno);


?>
