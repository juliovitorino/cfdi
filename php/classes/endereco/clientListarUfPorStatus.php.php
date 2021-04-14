<?php 

// URL http://localhost/cfdi/php/classes/endereco/clientListarUfPorStatus.php

require_once 'ufServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UfServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

$retorno = $csi->listarUfPorStatus($status,1,2);
var_dump($retorno);

$retorno = $csi->listarUfPorStatus($status,2,2);
var_dump($retorno);

$retorno = $csi->listarUfPorStatus($status,3,2);
var_dump($retorno);


?>
