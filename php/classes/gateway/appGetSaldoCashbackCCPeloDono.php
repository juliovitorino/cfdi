<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appGetSaldoCashbackCCPeloDono.php?tokenid=9794cd8f7fbc82542ab1ccb57291642a2219a3cb&tokenidr=764eddccdd5228e461bef3410850f63035b8ddb1
// URL http://localhost/cfdi/php/classes/gateway/appGetSaldoCashbackCCPeloDono.php?tokenid=t&tokenidr=po

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$tokenResgatante = $_GET['tokenidr'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend

// Busca ID do usuário que está solicitando o resgate
$sessdtotmp = $ssi->obterRegistroDonoTokenSessao($tokenResgatante);
/*
var_dump($sessdtotmp);
echo "<br>";
echo "<br>";
var_dump($sessaodto);
echo "<br>";
echo "<br>";
*/
$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->getSaldoCashbackCCPeloDono($sessdtotmp->usuariodto->id, $sessaodto->usuariodto->id );
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


?>
