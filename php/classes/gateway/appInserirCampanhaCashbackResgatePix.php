<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaCashbackResgatePix.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaCashbackResgatePix.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaCashbackResgatePix.php?tokenid=tk&idUsuarioDevedor=tr&tipoChavePix=tr&chavePix=tr&valorResgate=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaCashbackResgatePix.php

/**
*
* appInserirCampanhaCashbackResgatePix - Controlador para permitir acesso ao backend no método cadastrar
* da classe CampanhaCashbackResgatePixServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/07/2021 15:11:48
*
*/

require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixServiceImpl.php';
require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new CampanhaCashbackResgatePixDTO();

//--$dto->id = $_POST['id'];
$dto->idUsuarioDevedor = $_POST['idUsuarioDevedor'];
$dto->idUsuarioSolicitante = $sessaodto->usuariodto->id; //$_POST['idUsuarioSolicitante'];
$dto->tipoChavePix = (int) $_POST['tipoChavePix'];
$dto->chavePix = $_POST['chavePix'];
$dto->valorResgate = floatval($_POST['valorResgate']);
/*
$dto->autenticacaoBco = $_POST['autenticacaoBco'];
$dto->estagioRealTime = $_POST['estagioRealTime'];
$dto->dtEstagioAnalise = $_POST['dtEstagioAnalise'];
$dto->dtEstagioFinanceiro = $_POST['dtEstagioFinanceiro'];
$dto->dtEstagioErro = $_POST['dtEstagioErro'];
$dto->dtEstagioTranfBco = $_POST['dtEstagioTranfBco'];
$dto->txtLivreEstagioRT = $_POST['txtLivreEstagioRT'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];
*/

$csi = new CampanhaCashbackResgatePixServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
