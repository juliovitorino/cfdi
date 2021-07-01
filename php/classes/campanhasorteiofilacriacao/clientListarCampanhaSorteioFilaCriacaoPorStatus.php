<?php 

// URL http://localhost/cfdi/php/classes/campanhasorteiofilacriacao/clientListarCampanhaSorteioFilaCriacaoPorStatus.php

require_once 'CampanhaSorteioFilaCriacaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CampanhaSorteioFilaCriacaoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarCampanhaSorteioFilaCriacaoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarCampanhaSorteioFilaCriacaoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCampanhaSorteioFilaCriacaoPorStatus($status,3,2);
var_dump($retorno);


?>

