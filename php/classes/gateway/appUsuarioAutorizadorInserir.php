<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appUsuarioAutorizadorInserir.php?tokenid=cb1e&authtoken=1&campid=1&perm=00
// URL http://localhost/cfdi/php/classes/gateway/appUsuarioAutorizadorInserir.php?tokenid=faafa05a46457c3a516694a1a6d3384a6076a7b0&authtoken=8441e32904d8ab1bdea99d3cdf13faa0a3a2fcfb&campid=1000&perm=00

// Importar dependencias
require_once '../usuarioautorizador/UsuarioAutorizadorServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid']; // Autorizador
$authtoken = $_GET['authtoken']; // Usuário que está sendo autorizado
$campid = $_GET['campid']; // Campanha
$perm = $_GET['perm']; // Permissao

include_once '../../inc/validarTokenApp.php';

// >>>Backend

// Obtem a Ficha completa do token do usuário que está sendo autorizado
$sessdtotmp = $ssi->obterRegistroDonoTokenSessao($authtoken);

// Encapsula dados para envio do backend
$dto = new UsuarioAutorizadorDTO();
$dto->id_autorizador = $sessaodto->usuariodto->id;
$dto->id_usuario = $sessdtotmp->usuariodto->id;
$dto->id_campanha = (int) $campid;
$dto->tipo = 'T'; // por default é sempre temporário a permissao
$dto->permissao = $perm;
$dto->dataInicio = Util::getNow();
$dto->dataTermino = Util::getNow();

$csi = new UsuarioAutorizadorServiceImpl();
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);

?>
