<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirRecurso.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirRecurso.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&descricao=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirRecurso.php

/**
*
* appInserirRecurso - Controlador para permitir acesso ao backend no método cadastrar
* da classe RecursoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 08:54:31
*
*/

require_once '../recurso/RecursoServiceImpl.php';
require_once '../recurso/RecursoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new RecursoDTO();

$dto->id = $_POST['id'];
$dto->descricao = $_POST['descricao'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new RecursoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
