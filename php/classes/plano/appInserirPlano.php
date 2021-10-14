<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirPlano.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirPlano.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&nome=tr
&permissao=tr
&valor=tr
&tipo=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirPlano.php

/**
*
* appInserirPlano - Controlador para permitir acesso ao backend no método cadastrar
* da classe PlanoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 08/09/2021 14:43:48
*
*/

require_once '../plano/PlanoServiceImpl.php';
require_once '../plano/PlanoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
include_once '../../inc/validarTokenApp.php';

$dto = new PlanoDTO();

$dto->id = $_POST['id'];
$dto->nome = $_POST['nome'];
$dto->permissao = $_POST['permissao'];
$dto->valor = $_POST['valor'];
$dto->tipo = $_POST['tipo'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new PlanoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
