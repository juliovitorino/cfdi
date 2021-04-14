<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioPublicidadeProx24h.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioPublicidadeProx24h.php?tokenid=5dc12a47928bab564e1984e20869e3d24532917a&pag=1

// Importar dependencias
require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new UsuarioPublicidadeServiceImpl();
$retorno = $csi->listarUsuarioPublicidadeProx24h($sessaodto->usuariodto->id, $status, $pag, 0, 15, 1);

echo json_encode($retorno);


?>


