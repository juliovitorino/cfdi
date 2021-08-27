<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirFundoParticipacaoGlobal.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirFundoParticipacaoGlobal.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idUsuarioParticipante=tr
&idUsuarioBonificado=tr
&idPlanoFatura=tr
&tipoMovimento=tr
&valorTransacao=tr
&descricao=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirFundoParticipacaoGlobal.php

/**
*
* appInserirFundoParticipacaoGlobal - Controlador para permitir acesso ao backend no método cadastrar
* da classe FundoParticipacaoGlobalServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 18/08/2021 12:49:00
*
*/

require_once '../fundoparticipacaoglobal/FundoParticipacaoGlobalServiceImpl.php';
require_once '../fundoparticipacaoglobal/FundoParticipacaoGlobalDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new FundoParticipacaoGlobalDTO();

$dto->id = $_POST['id'];
$dto->idUsuarioParticipante = $_POST['idUsuarioParticipante'];
$dto->idUsuarioBonificado = $_POST['idUsuarioBonificado'];
$dto->idPlanoFatura = $_POST['idPlanoFatura'];
$dto->tipoMovimento = $_POST['tipoMovimento'];
$dto->valorTransacao = $_POST['valorTransacao'];
$dto->descricao = $_POST['descricao'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new FundoParticipacaoGlobalServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
