<?php 

// URL http://localhost/cfdi/php/classes/endereco/clientListarCidadePorStatus.php

require_once 'cidadeServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CidadeServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

$retorno = $csi->listarCidadePorStatus($status,1,2,2);
var_dump($retorno);

$retorno = $csi->listarCidadePorStatus($status,2,2,2);
var_dump($retorno);

$retorno = $csi->listarCidadePorStatus($status,3,2,2);
var_dump($retorno);


?>
