<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appGetCarimboLivre.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&campanha=3
// URL http://localhost/cfdi/php/classes/gateway/appGetCarimboLivre.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&campanha=3

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$idcampanha = $_GET['campanha'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaServiceImpl();
$retorno = $csi->getCarimboLivre($idcampanha, $sessaodto->usuariodto->id );
echo json_encode($retorno);

?>