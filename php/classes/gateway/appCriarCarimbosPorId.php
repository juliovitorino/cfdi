<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appCriarCarimbosPorId.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&camp=1
// URL http://localhost/cfdi/php/classes/gateway/appCriarCarimbosPorId.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&camp=1

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_campanha = $_GET['camp'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
//$csi = new CampanhaServiceImpl();
//$retorno = $csi->listarCampanhasUsuario($sessaodto->usuariodto->id);
//var_dump($retorno);

$csi = new CampanhaServiceImpl();
$retorno = $csi->criarCampanhaPorParceiroCampanha($sessaodto->usuariodto->id, $id_campanha);  

// retorna resultado
echo json_encode($retorno);


?>