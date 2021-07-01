<?php 

// URL http://localhost/cfdi/php/classes/registroindicacao/clientListarRegistroIndicacaoPorStatus.php

require_once 'RegistroIndicacaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new RegistroIndicacaoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarRegistroIndicacaoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarRegistroIndicacaoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarRegistroIndicacaoPorStatus($status,3,2);
var_dump($retorno);


?>
