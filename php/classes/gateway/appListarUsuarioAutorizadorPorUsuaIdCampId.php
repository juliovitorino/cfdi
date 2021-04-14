<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioAutorizadorPorUsuaIdCampId.php?tokenid=cb1&cmpid=2&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioAutorizadorPorUsuaIdCampId.php?tokenid=cb1&cmpid=2&pag=1

// Importar dependencias
require_once '../usuarioautorizador/UsuarioAutorizadorServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$idcampanha = $_GET['cmpid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = "'C','A'";
$qtde = 50;
$coluna=1;
$csi = new UsuarioAutorizadorServiceImpl();
$retorno = $csi->listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($sessaodto->usuariodto->id, $idcampanha, $status, $pag, $qtde,$coluna,1);

echo json_encode($retorno);


?>
