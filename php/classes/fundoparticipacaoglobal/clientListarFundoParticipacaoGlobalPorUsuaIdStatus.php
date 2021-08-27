<?php 

// URL http://localhost/cfdi/php/classes/fundoparticipacaoglobal/clientListarFundoParticipacaoGlobalPorUsuaIdStatus.php

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new FundoParticipacaoGlobalServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1;

// Imprime a 1a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarFundoParticipacaoGlobalPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);


?>

