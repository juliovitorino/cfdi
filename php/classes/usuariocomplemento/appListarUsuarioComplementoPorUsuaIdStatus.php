<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioComplementoPorUsuaIdStatus.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioComplementoPorUsuaIdStatus.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../usuariocomplemento/UsuarioComplementoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new UsuarioComplementoServiceImpl();
$retorno = $csi->listarUsuarioComplementoPorUsuaIdStatus($sessaodto->usuariodto->id, $status, $pag);

echo json_encode($retorno);


?>
