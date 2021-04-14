<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhaParticipantes.php?tokenid=cb1&campid=1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarCampanhaParticipantes.php?tokenid=cb1&campid=1&pag=1

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_campanha = $_GET['campid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasParticipantes($id_campanha, $sessaodto->usuariodto->id, $pag);

echo json_encode($retorno);


?>