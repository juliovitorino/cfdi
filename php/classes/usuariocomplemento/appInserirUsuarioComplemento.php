<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirUsuarioComplemento.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioComplemento.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idUsuario=tr
&ddd=tr
&telefone=tr
&nomeReceitaFederal=tr
&nomeResponsavel=tr
&urlsite=tr
&urlFacebook=tr
&urlInstagram=tr
&urlPinterest=tr
&urlSkype=tr
&urlTwitter=tr
&urlFacetime=tr
&urlResponsavel=tr
&urlFoto2=tr
&urlFoto3=tr
&descLivre=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioComplemento.php

/**
*
* appInserirUsuarioComplemento - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioComplementoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 07/09/2021 11:00:05
*
*/

require_once '../usuariocomplemento/UsuarioComplementoServiceImpl.php';
require_once '../usuariocomplemento/UsuarioComplementoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new UsuarioComplementoDTO();

$dto->id = $_POST['id'];
$dto->idUsuario = $_POST['idUsuario'];
$dto->ddd = $_POST['ddd'];
$dto->telefone = $_POST['telefone'];
$dto->nomeReceitaFederal = $_POST['nomeReceitaFederal'];
$dto->nomeResponsavel = $_POST['nomeResponsavel'];
$dto->urlsite = $_POST['urlsite'];
$dto->urlFacebook = $_POST['urlFacebook'];
$dto->urlInstagram = $_POST['urlInstagram'];
$dto->urlPinterest = $_POST['urlPinterest'];
$dto->urlSkype = $_POST['urlSkype'];
$dto->urlTwitter = $_POST['urlTwitter'];
$dto->urlFacetime = $_POST['urlFacetime'];
$dto->urlResponsavel = $_POST['urlResponsavel'];
$dto->urlFoto2 = $_POST['urlFoto2'];
$dto->urlFoto3 = $_POST['urlFoto3'];
$dto->descLivre = $_POST['descLivre'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new UsuarioComplementoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
