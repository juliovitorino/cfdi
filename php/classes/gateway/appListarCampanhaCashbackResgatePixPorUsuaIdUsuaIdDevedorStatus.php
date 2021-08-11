
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus.php?tokenid=cb1&usuaidDevedor=1&pag=1
// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appListarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus.php?tokenid=2ff6fc199ae0527ea105377d6db8cd68ff840d14&usuaidDevedor=1&pag=1

// Importar dependencias
require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$usuaidDevedor = (int) $_GET['usuaidDevedor'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$qtde = 50;
$coluna=1;
$ordem=1;
$csi = new CampanhaCashbackResgatePixServiceImpl();
$retorno = $csi->listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($sessaodto->usuariodto->id, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem);

echo json_encode($retorno);


?>
