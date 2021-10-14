<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarPlanoPorStatusTipo.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarPlanoPorUsuaIdStatus.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../plano/PlanoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$tipo = 'PLA'; // Tipo Plano
$csi = new PlanoServiceImpl();
$retorno = $csi->listarPlanoPorStatusTipo($status, $tipo, $pag);

echo json_encode($retorno);


?>
