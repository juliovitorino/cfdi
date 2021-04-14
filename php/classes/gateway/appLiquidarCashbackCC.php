<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appLiquidarCashbackCC.php?tokenid=ch1&usuaid=7&vlr=1.09&desc=bxzc
// URL http://localhost/cfdi/php/classes/gateway/appLiquidarCashbackCC.php?tokenid=ch1&usuaid=7&vlr=1.09&desc=bxzc

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_usuario = $_GET['usuaid'];
$vllancar = (double) $_GET['vlr'];
$descricao = $_GET['desc'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$id_dono = $sessaodto->usuariodto->id;

$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->liquidarCashbackCC($id_usuario, $id_dono, $vllancar, $descricao);

echo json_encode($retorno);

?>