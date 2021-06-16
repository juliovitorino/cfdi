<?php 

// URL http://localhost/cfdi/php/classes/campanhasorteio/clientListarCampanhaSorteioPorStatus.php

require_once 'CampanhaSorteioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaSorteioServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarCampanhaSorteioPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarCampanhaSorteioPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCampanhaSorteioPorStatus($status,3,2);
var_dump($retorno);


?>

