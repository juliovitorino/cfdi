<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appTransferirEntreMembroCashbackCC.php?tokenid=ch1&usuaid=dfgdf&donoid=12&vlr=1.09&desc=bxzc
// URL http://localhost/cfdi/php/classes/gateway/appTransferirEntreMembroCashbackCC.php?tokenid=ch1&usuaid=cbahsdf&donoid=12&vlr=1.09&desc=bxzc

// Importar dependencias
require_once '../campanhacashbackcc/CampanhaCashbackCCServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id_destino = $_GET['usuaid'];
$id_dono = $_GET['donoid'];
$vllancar = (double) $_GET['vlr'];
$descricao = $_GET['desc'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$id_usuario = $sessaodto->usuariodto->id;

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


$csi = new CampanhaCashbackCCServiceImpl();
$retorno = $csi->transferirEntreMembroCashbackCC($id_usuario, $sessaotmp->usuariodto->id,$id_dono, $vllancar, $descricao);

echo json_encode($retorno);

?>