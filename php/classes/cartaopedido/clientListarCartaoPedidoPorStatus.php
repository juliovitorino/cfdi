<?php 

// URL http://localhost/cfdi/php/classes/cartaopedido/clientListarCartaoPedidoPorStatus.php

require_once 'CartaoPedidoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new CartaoPedidoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarCartaoPedidoPorStatus($status,1,2);
var_dump($retorno);


?>


