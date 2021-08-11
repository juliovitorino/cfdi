<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appMoverCartao.php?tokenid=ch1&tokendest=dfgdf&cardid=12
// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appMoverCartao.php?tokenid=ch1&tokendest=dfgdf&cardid=12

// Importar dependencias
require_once '../cartao/cartaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_destino = $_GET['tokendest'];
$idCartao = (int) $_GET['cardid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend

// tive de abrir exceção neste código
$sessaotmp = $ssi->obterRegistroDonoTokenSessao($id_destino);

switch ($sessaotmp->msgcode) {
    case ConstantesMensagem::SESSAO_INVALIDA_DO_USUARIO:
    case ConstantesMensagem::SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN:
    case ConstantesMensagem::USUARIO_BLOQUEADO_ENVIAR_ZAP:
        echo json_encode($sessaodto);
        exit(0);
        break;
    
    default:
        # code...
        break;
}

$idusuarioDono = $sessaodto->usuariodto->id;
$idusuarioDestino = $sessaotmp->usuariodto->id;

$csi = new CartaoServiceImpl();
$retorno = $csi->moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
echo json_encode($retorno);

?>