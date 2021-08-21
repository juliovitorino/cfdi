<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirSeglog.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirSeglog.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idgafa=tr
&id_usuario=tr
&funcao=tr
&incrudCriar=tr
&incrudRecuperar=tr
&incrudAtualizar=tr
&incrudExcluir=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirSeglog.php

/**
*
* appInserirSeglog - Controlador para permitir acesso ao backend no método cadastrar
* da classe SeglogServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 21/08/2021 12:30:09
*
*/

require_once '../seglog/SeglogServiceImpl.php';
require_once '../seglog/SeglogDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new SeglogDTO();

$dto->id = $_POST['id'];
$dto->idgafa = $_POST['idgafa'];
$dto->id_usuario = $_POST['id_usuario'];
$dto->funcao = $_POST['funcao'];
$dto->incrudCriar = $_POST['incrudCriar'];
$dto->incrudRecuperar = $_POST['incrudRecuperar'];
$dto->incrudAtualizar = $_POST['incrudAtualizar'];
$dto->incrudExcluir = $_POST['incrudExcluir'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new SeglogServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
