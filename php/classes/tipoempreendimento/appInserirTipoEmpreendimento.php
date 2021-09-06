<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirTipoEmpreendimento.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirTipoEmpreendimento.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&descricao=tr
&urlimg=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirTipoEmpreendimento.php

/**
*
* appInserirTipoEmpreendimento - Controlador para permitir acesso ao backend no método cadastrar
* da classe TipoEmpreendimentoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 08:28:01
*
*/

require_once '../tipoempreendimento/TipoEmpreendimentoServiceImpl.php';
require_once '../tipoempreendimento/TipoEmpreendimentoDTO.php';
require_once '../util/util.php';
include_once '../../inc/validarTokenApp.php';

$dto = new TipoEmpreendimentoDTO();

$dto->id = $_POST['id'];
$dto->descricao = $_POST['descricao'];
$dto->urlimg = $_POST['urlimg'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new TipoEmpreendimentoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
