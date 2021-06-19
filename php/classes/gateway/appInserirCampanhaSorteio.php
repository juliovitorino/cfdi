<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php


 /*
Faça um Find/Replace em $_GET por $_POST e use os parametros na URL para simular um GET na HttpRequest

http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php?tokenid=c76&idCampanha=1004&nome=testeYK&urlRegulamento=qqhum&premio=qqcoisa&nuMaxTicketSorteio=3000

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php

/**
*
* appInserirCampanhaSorteio - Controlador para permitir acesso ao backend no método cadastrar
* da classe CampanhaSorteioServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
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
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new CampanhaSorteioDTO();

$dto->id_campanha = $_POST['idCampanha'];
$dto->nome = $_POST['nome'];
$dto->urlRegulamento = $_POST['urlRegulamento'];
$dto->premio = $_POST['premio'];
$dto->maxTickets = (int) $_POST['nuMaxTicketSorteio'];

$csi = new CampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
