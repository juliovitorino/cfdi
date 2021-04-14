<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appLancarMovimentoCashbackCC.php?tokenid=cb&usuaid=7&vlr=1.09&&desc=loremipsum&&tl=C
// URL http://localhost/cfdi/php/classes/gateway/appLancarMovimentoCashbackCC.php?tokenid=cb&usuaid=7&vlr=1.09&&desc=loremipsum&&tl=C

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_usuario = $_GET['usuaid'];
$vllancar = (double) $_GET['vlr'];
$descricao =  $_GET['desc'];
$tipolancar =  $_GET['tl'];


include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->lancarMovimentoCashbackCC($id_usuario, $sessaodto->usuariodto->id, $vllancar, $descricao, $tipolancar);
echo json_encode($retorno);

?>