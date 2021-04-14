<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioPublicidadePorUsuaIdStatus.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioPublicidadePorUsuaIdStatus.php?tokenid=5dc12a47928bab564e1984e20869e3d24532917a&pag=1

// Importar dependencias
require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$statusAtivo = "'" . ConstantesVariavel::STATUS_ATIVO . "'";
$statusPendente = "'" . ConstantesVariavel::STATUS_PENDENTE . "'";
$status = "($statusAtivo,$statusPendente)";
$csi = new UsuarioPublicidadeServiceImpl();
$retorno = $csi->listarUsuarioPublicidadePorUsuaIdStatus($sessaodto->usuariodto->id, $status, $pag);

echo json_encode($retorno);


?>


