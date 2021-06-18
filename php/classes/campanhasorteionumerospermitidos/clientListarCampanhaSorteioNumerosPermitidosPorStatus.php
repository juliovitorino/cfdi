<?php 

// URL http://localhost/cfdi/php/classes/campanhasorteionumerospermitidos/clientListarCampanhaSorteioNumerosPermitidosPorStatus.php

require_once 'CampanhaSorteioNumerosPermitidosServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaSorteioNumerosPermitidosServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarCampanhaSorteioNumerosPermitidosPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarCampanhaSorteioNumerosPermitidosPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCampanhaSorteioNumerosPermitidosPorStatus($status,3,2);
var_dump($retorno);


?>

