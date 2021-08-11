<?php 

// URL http://localhost/cfdi/php/classes/cartaomoverhistorico/clientListarCartaoMoverHistoricoPorCartIdStatus.php

require_once 'CartaoMoverHistoricoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CartaoMoverHistoricoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$cartid = 1120;

// Imprime a 1a pagina
$retorno = $csi->listarCartaoMoverHistoricoPorCartIdStatus($cartid,$status,1,2);
echo json_encode($retorno);
/*
// Imprime a 2a pagina
$retorno = $csi->listarCartaoMoverHistoricoPorCartIdStatus($cartid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarCartaoMoverHistoricoPorCartIdStatus($cartid,$status,3,2);
var_dump($retorno);
*/

?>
