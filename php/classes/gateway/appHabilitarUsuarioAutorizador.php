<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appHabilitarUsuarioAutorizador.php?tokenid=cb1e&id=1&id_usuario=1&id_campanha=1&onoff=1
// URL http://localhost/cfdi/php/classes/gateway/appHabilitarUsuarioAutorizador.php?tokenid=fa&id=1&id_usuario=1&id_campanha=1&onoff=1

// Importar dependencias
require_once '../usuarioautorizador/UsuarioAutorizadorServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid']; // Autorizador
$id = $_POST['id']; // Campanha
$id_usuario = $_POST['id_usuario']; // Campanha
$campid = $_POST['id_campanha']; // Permissao
$ishabilitar = $_POST['onoff'] == "1" ? true : false; // Permissao

include_once '../../inc/validarTokenApp.php';

// >>>Backend

// Encapsula dados para envio do backend
$dto = new UsuarioAutorizadorDTO();
$dto->id = $id;
$dto->id_autorizador = $sessaodto->usuariodto->id;
$dto->id_usuario = $id_usuario;
$dto->id_campanha = (int) $campid;

$csi = new UsuarioAutorizadorServiceImpl();
$retorno = $csi->habilitarUsuarioAutorizador($dto, $ishabilitar);
echo json_encode($retorno);

?>
