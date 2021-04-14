<?php

// ====== padrão para identificação da sessão do usuário ===========
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
//$token = $_GET['tokenid'];
//$idcampanha = $_GET['campanha'];

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

switch ($sessaodto->msgcode) {
    case ConstantesMensagem::SESSAO_INVALIDA_DO_USUARIO:
        echo json_encode($sessaodto);
        exit(0);
        break;
    case ConstantesMensagem::SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN:
        echo json_encode($sessaodto);
        exit(0);
        break;
    case ConstantesMensagem::USUARIO_BLOQUEADO_ENVIAR_ZAP:
        echo json_encode($sessaodto);
        exit(0);
        break;
    
    default:
        # code...
        break;
}
// ====== padrão para identificação da sessão do usuário ===========
?>