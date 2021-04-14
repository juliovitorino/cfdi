<?php

// http://elitefinanceira.com/cfdi/php/classes/gateway/appRealizarResgateCartao.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&hash=8c47f368678ba39dc3e074102b60c526c83d5687
// http://localhost/cfdi/php/classes/gateway/appRealizarResgateCartao.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&hash=8c47f368678ba39dc3e074102b60c526c83d5687

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$hash = $_GET['hash'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $csi->realizarResgateCartao($hash, $sessaodto->usuariodto->id);
echo json_encode($retorno);

?>