<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appResgateCashbackCC.php?tokenid=ch1&usuaid=7&vlr=1.09
// URL http://localhost/cfdi/php/classes/gateway/appResgateCashbackCC.php?tokenid=ch1&usuaid=7&vlr=1.09

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_usuario = $_GET['usuaid'];
$vllancar = (double) $_GET['vlr'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$id_usuario = $id_usuario;
$id_dono = $sessaodto->usuariodto->id;
$descricao = 'Resgate cashback ID =>' . sha1($token . Util::getCodigo(2048)) ;
$tipolancar = ConstantesVariavel::DEBITO;

$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->ResgatarTotalCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);

echo json_encode($retorno);

?>