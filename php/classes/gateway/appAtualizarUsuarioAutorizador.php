<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appAtualizarUsuarioAutorizador.php?tokenid=cv&cardid=1
// URL http://localhost/cfdi/php/classes/gateway/appAtualizarUsuarioAutorizador.php?tokenid=cb&id=27&id_usuario=4&id_campanha=7&id_autorizador=1&tipo=T&permissao=00&dataInicio=17-09-2019%20%16:49:00&dataTermino=18-09-2019%20%16:49:01

// Importar dependencias
require_once '../usuarioautorizador/UsuarioAutorizadorServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$dto = new UsuarioAutorizadorDTO();
$dto->id = $_POST['id'];
$dto->id_usuario = $_POST['id_usuario'];
$dto->id_campanha = $_POST['id_campanha'];
$dto->id_autorizador = $sessaodto->usuariodto->id;
$dto->tipo = $_POST['tipo'];
$dto->permissao = $_POST['permissao'];
$dto->dataInicio = Util::DMYHMiS_to_MySQLDate($_POST['dataInicio']);
$dto->dataTermino = Util::DMYHMiS_to_MySQLDate($_POST['dataTermino']);

$csi = new UsuarioAutorizadorServiceImpl();
$retorno = $csi->atualizar($dto);
echo json_encode($retorno);

?>
