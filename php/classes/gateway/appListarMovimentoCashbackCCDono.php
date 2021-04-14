<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarMovimentoCashbackCCDono.php?tokenid=vc&dono=1&numdias=7
// URL http://localhost/cfdi/php/classes/gateway/appListarMovimentoCashbackCCDono.php?tokenid=vc&dono=1&numdias=7

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_dono = $_GET['dono']; 
$numdias = $_GET['numdias'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaCashbackCCServiceImpl();

// Aqui inverte o pedido ao backend, pq id_dono é o resgatante e não o patrocinador
$retorno = $csi->listarMovimentoCashbackCC($id_dono, $sessaodto->usuariodto->id, $numdias);
echo json_encode($retorno);

?>
