<?php 

// URL http://localhost/cfdi/php/classes/funcoesadministrativas/clientListarFuncoesAdministrativasPorStatus.php

require_once 'FuncoesAdministrativasServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new FuncoesAdministrativasServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarFuncoesAdministrativasPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarFuncoesAdministrativasPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarFuncoesAdministrativasPorStatus($status,3,2);
var_dump($retorno);


?>
