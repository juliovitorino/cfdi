<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php


 /*
Faça um Find/Replace em $_GET por $_POST e use os parametros na URL para simular um GET na HttpRequest

http://elitefinanceira.com/cfdi/php/classes/gateway/appAtivarCampanhaSorteio.php?tokenid=33ca7f6521c4e0f181f6675f2388cffc209ac710&casoid=1000

 */

/**
*
* appAtivarCampanhaSorteio - Ativar uma campanha em status = PENDENTE
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 16/06/2021 14:51:23
*
*/

require_once '../campanhasorteio/CampanhaSorteioServiceImpl.php';
require_once '../campanhasorteio/CampanhaSorteioDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

$id = (int) $_GET['casoid'];

$csi = new CampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->ativarCampanhaSorteio($id);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
