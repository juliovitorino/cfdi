<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdminUsuario.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdminUsuario.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idGrupoAdmFuncoesAdm=tr
&id_usuario=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdminUsuario.php

/**
*
* appInserirGrupoAdminFuncoesAdminUsuario - Controlador para permitir acesso ao backend no método cadastrar
* da classe GrupoAdminFuncoesAdminUsuarioServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 19:25:25
*
*/

require_once '../grupoadminfuncoesadminusuario/GrupoAdminFuncoesAdminUsuarioServiceImpl.php';
require_once '../grupoadminfuncoesadminusuario/GrupoAdminFuncoesAdminUsuarioDTO.php';
require_once '../util/util.php';

include_once '../../inc/validarTokenApp.php';

$dto = new GrupoAdminFuncoesAdminUsuarioDTO();

$dto->id = $_POST['id'];
$dto->idGrupoAdmFuncoesAdm = $_POST['idGrupoAdmFuncoesAdm'];
$dto->id_usuario = $_POST['id_usuario'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new GrupoAdminFuncoesAdminUsuarioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
