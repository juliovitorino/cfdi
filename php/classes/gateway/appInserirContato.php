<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirContato.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirContato.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&nome=tr
&email=tr
&mensagem=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirContato.php

/**
*
* appInserirContato - Controlador para permitir acesso ao backend no método cadastrar
* da classe ContatoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 31/08/2021 08:17:22
*
*/

require_once '../contato/ContatoServiceImpl.php';
require_once '../contato/ContatoDTO.php';
require_once '../util/util.php';

// este processo não tem a necessidade de validação do token
//include_once '../../inc/validarTokenApp.php';

$dto = new ContatoDTO();

$dto->nome = $_POST['nome'];
$dto->email = $_POST['email'];
$dto->origem = $_POST['origem'];
$dto->mensagem = $_POST['mensagem'];


$csi = new ContatoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
