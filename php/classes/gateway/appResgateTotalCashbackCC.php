<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appResgateTotalCashbackCC.php?tokenid=cb&usuaid=7&vlr=1.09
// URL http://localhost/cfdi/php/classes/gateway/appResgateTotalCashbackCC.php?tokenid=cb&usuaid=7&vlr=1.09

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_usuario = $_GET['usuaid'];
$vllancar = (double) $_GET['vlr'];
$descricao =  "Resgate Total do Cashback";
$tipolancar =  ConstantesVariavel::DEBITO;


include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->ResgatarTotalCashbackCC($id_usuario, $sessaodto->usuariodto->id, $vllancar, $descricao, $tipolancar);
echo json_encode($retorno);

?>