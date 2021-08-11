<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appGetSaldoCashbackCC.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3
// URL http://localhost/cfdi/php/classes/gateway/appGetSaldoCashbackCC.php?tokenid=3a0aa916fcc30cbc16e589c1134ff2294e0add07

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->getSaldoCashbackCC($sessaodto->usuariodto->id);
//var_dump($retorno);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


?>