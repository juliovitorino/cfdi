<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appCartaoLike.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&cardid=1
// URL http://localhost/cfdi/php/classes/gateway/appCartaoLike.php?tokenid=cb1ed118944b2c4738e8f86765906675d9562de3&cardid=1

// Importar dependencias
require_once '../cartao/cartaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_cartao = $_GET['cardid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $csi->atualizarCartaoLike($id_cartao,$sessaodto->usuariodto->id);
echo json_encode($retorno);

?>