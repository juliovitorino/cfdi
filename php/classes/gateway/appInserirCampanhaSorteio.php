<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteio.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&id_campanha=tr
&nome=tr
&urlRegulamento=tr
&premio=tr
&dataComecoSorteio=tr
&dataFimSorteio=tr
&maxTickets=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

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

$dto->id = $_POST['id'];
$dto->id_campanha = $_POST['id_campanha'];
$dto->nome = $_POST['nome'];
$dto->urlRegulamento = $_POST['urlRegulamento'];
$dto->premio = $_POST['premio'];
$dto->dataComecoSorteio = $_POST['dataComecoSorteio'];
$dto->dataFimSorteio = $_POST['dataFimSorteio'];
$dto->maxTickets = $_POST['maxTickets'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new CampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
