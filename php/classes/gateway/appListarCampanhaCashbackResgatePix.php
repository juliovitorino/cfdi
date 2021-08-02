<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhaCashbackResgatePix.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarCampanhaCashbackResgatePix.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaCashbackResgatePixServiceImpl();
$retorno = $csi->listarCampanhaCashbackResgatePix($pag);

echo json_encode($retorno);


?>

