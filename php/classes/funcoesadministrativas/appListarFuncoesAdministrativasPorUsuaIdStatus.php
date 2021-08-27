
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarFuncoesAdministrativasPorUsuaIdStatus.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarFuncoesAdministrativasPorUsuaIdStatus.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../funcoesadministrativas/FuncoesAdministrativasServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new FuncoesAdministrativasServiceImpl();
$retorno = $csi->listarFuncoesAdministrativasPorUsuaIdStatus($sessaodto->usuariodto->id, $status, $pag);

echo json_encode($retorno);


?>
