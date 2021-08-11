<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCartaoMoverHistoricoPorCartIdStatus.php?tokenid=cb1&cartid=12&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarCartaoMoverHistoricoPorCartIdStatus.php?tokenid=cb1&cartid=12&pag=1

// Importar dependencias
require_once '../cartaomoverhistorico/CartaoMoverHistoricoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$cartid = $_GET['cartid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new CartaoMoverHistoricoServiceImpl();
$retorno = $csi->listarCartaoMoverHistoricoPorCartIdStatus($cartid, $status, $pag);

echo json_encode($retorno);


?>
