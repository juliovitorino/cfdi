<?php 

// URL http://localhost/cfdi/php/classes/fundoparticipacaoglobal/clientListarFundoParticipacaoGlobalPorStatus.php

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new FundoParticipacaoGlobalServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorStatus($status,3,2);
var_dump($retorno);


?>
