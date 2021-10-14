<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appPesquisarPerfilUsuario.php
// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appPesquisarPerfilUsuario.php?tokenid=94ff924c950e30271f2005c3018009e7f5f44d8d


 /*
Faça um Find/Replace em $_GET por $_POST e use os parametros na URL para simular um GET na HttpRequest

http://elitefinanceira.com/cfdi/php/classes/gateway/appPesquisarPerfilUsuario.php?tokenid=c5e6c403027c888c64c75c2cbd05444b3c71de96

 */

/**
*
* appPesquisarPerfilUsuario - Apagar uma campanha sorteio de forma permanente
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 11:08:23
*
*/

require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../usuarios/PerfilDTO.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

$usi = new UsuarioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $usi->pesquisarPerfilCompleto($sessaodto->usuariodto->id);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
