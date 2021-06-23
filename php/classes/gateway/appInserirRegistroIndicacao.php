<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirRegistroIndicacao.php?tokenid=xxx&tokenidui=yyy
// URL http://localhost/cfdi/php/classes/gateway/appInserirRegistroIndicacao.php


/**
*
* appInserirRegistroIndicacao - Controlador para permitir acesso ao backend no método cadastrar
* da classe RegistroIndicacaoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/06/2021 14:44:26
*
*/

require_once '../registroindicacao/RegistroIndicacaoServiceImpl.php';
require_once '../registroindicacao/RegistroIndicacaoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$tokenidui = $_GET['tokenidui'];

include_once '../../inc/validarTokenApp.php';

// Obtem o token o usuario indicado
$ssessaoboui = new SessaoServiceImpl();
$ssessaodtoui = $ssessaoboui->obterRegistroDonoTokenSessao($tokenidui);

switch ($ssessaodtoui->msgcode) {
    case ConstantesMensagem::SESSAO_INVALIDA_DO_USUARIO:
        echo json_encode($ssessaodtoui);
        exit(0);
        break;
    case ConstantesMensagem::SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN:
        echo json_encode($ssessaodtoui);
        exit(0);
        break;
    case ConstantesMensagem::USUARIO_BLOQUEADO_ENVIAR_ZAP:
        echo json_encode($ssessaodtoui);
        exit(0);
        break;
    
    default:
        # code...
        break;
}

$dto = new RegistroIndicacaoDTO();
$dto->idUsuarioPromotor = $sessaodto->usuariodto->id;
$dto->idUsuarioIndicado = $ssessaodtoui->usuariodto->id;

$csi = new RegistroIndicacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
