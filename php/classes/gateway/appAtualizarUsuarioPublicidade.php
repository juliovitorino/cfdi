<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appAtualizarUsuarioPublicidade.php?tokenid=tk&id_usuario=1&titulo=titulo&descricao=descricao&dataInicio=2019-08-12 00:00:00&dataTermino=2019-08-25 00:00:00&vlNormal=25.99&vlPromo=12.99&observacao=ons&dataRemover=2019-10-25 08:27:26
// URL http://localhost/cfdi/php/classes/gateway/appAtualizarUsuarioPublicidade.php?tokenid=tk&id_usuario=1&titulo=titulo&descricao=descricao&dataInicio=2019-08-12 00:00:00&dataTermino=2019-08-25 00:00:00&vlNormal=25.99&vlPromo=12.99&observacao=ons&dataRemover=2019-10-25 08:27:26

 /*
Faça um Find/Replace em POST por POST e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id_usuario=tr
&titulo=tr
&descricao=tr
&dataInicio=tr
&dataTermino=tr
&vlNormal=tr
&vlPromo=tr
&observacao=tr
&dataRemover=tr
*/


/**
*
* appInserirUsuarioPublicidade - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioPublicidadeServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 25/08/2019 08:23:18
*
*/

require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';
require_once '../usuariopublicidade/UsuarioPublicidadeDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new UsuarioPublicidadeDTO();

$dto->id = (int) $_POST['id'];
$dto->id_usuario = $sessaodto->usuariodto->id; //$_POST['id_usuario'];
$dto->titulo = $_POST['titulo'];
$dto->descricao = $_POST['descricao'];
$dto->dataInicio = Util::DMYHMiS_to_MySQLDate($_POST['dataInicio']);
$dto->dataTermino =  Util::DMYHMiS_to_MySQLDate($_POST['dataTermino']);
$dto->vlNormal = (double) $_POST['vlNormal'];
$dto->vlPromo = (double) $_POST['vlPromo'];
$dto->observacao = $_POST['observacao'];
$dto->dataRemover = $_POST['dataRemover'];


$csi = new UsuarioPublicidadeServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->atualizar($dto);
echo json_encode($retorno);

?>
