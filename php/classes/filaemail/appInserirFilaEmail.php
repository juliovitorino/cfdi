<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirFilaEmail.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirFilaEmail.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&nomeFila=tr
&emailDe=tr
&emailPara=tr
&assunto=tr
&prioridade=tr
&template=tr
&nrMaxTentativas=tr
&nrRealTentativas=tr
&dataPrevisaoEnvio=tr
&dataRealEnvio=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirFilaEmail.php

/**
*
* appInserirFilaEmail - Controlador para permitir acesso ao backend no método cadastrar
* da classe FilaEmailServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 01/09/2021 15:29:49
*
*/

require_once '../filaemail/FilaEmailServiceImpl.php';
require_once '../filaemail/FilaEmailDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new FilaEmailDTO();

$dto->id = $_POST['id'];
$dto->nomeFila = $_POST['nomeFila'];
$dto->emailDe = $_POST['emailDe'];
$dto->emailPara = $_POST['emailPara'];
$dto->assunto = $_POST['assunto'];
$dto->prioridade = $_POST['prioridade'];
$dto->template = $_POST['template'];
$dto->nrMaxTentativas = $_POST['nrMaxTentativas'];
$dto->nrRealTentativas = $_POST['nrRealTentativas'];
$dto->dataPrevisaoEnvio = $_POST['dataPrevisaoEnvio'];
$dto->dataRealEnvio = $_POST['dataRealEnvio'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new FilaEmailServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
