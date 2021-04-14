<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appCancelarCampanha.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&campid=1
// URL http://localhost/cfdi/php/classes/gateway/appCancelarCampanha.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&campid=1

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$idcamp = $_GET['campid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaServiceImpl();
$dto = new CampanhaDTO();
$dto->id = $idcamp;
$dto->id_usuario = $sessaodto->usuariodto->id;
$retorno = $csi->cancelar($dto);
echo json_encode($retorno);


?>