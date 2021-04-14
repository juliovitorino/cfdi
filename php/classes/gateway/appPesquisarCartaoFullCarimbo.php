<?php

// URL http://localhost/cfdi/php/classes/gateway/appPesquisarCartaoFullCarimbo.php?tokenid=b84cb7bd08d7aa8c9c2439c0de4151d5f59f1585&qrc=58ec825c9c8211af&status=A
// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appPesquisarCartaoFullCarimbo.php?tokenid=cdaecd0f0834260804e3778758ec825c9c8211af&qrc=158ec825c9c8211af&status=A

// Importar dependencias
require_once '../cartao/cartaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$qrcode = $_GET['qrc'];
$status = $_GET['status'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $status == '' 
    ? $csi->pesquisarCartaoFullCarimbo($qrcode, $sessaodto->usuariodto->id) :
    $csi->pesquisarCartaoFullCarimbo($qrcode, $sessaodto->usuariodto->id, $status);
echo json_encode($retorno);

?>