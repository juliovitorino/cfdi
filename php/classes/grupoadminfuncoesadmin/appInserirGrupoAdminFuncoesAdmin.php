<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdmin.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdmin.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idGrupoAdministracao=tr
&idFuncoesAdministrativas=tr
&descricao=tr
&incrudCriar=tr
&incrudRecuperar=tr
&incrudAtualizar=tr
&incrudExcluir=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdminFuncoesAdmin.php

/**
*
* appInserirGrupoAdminFuncoesAdmin - Controlador para permitir acesso ao backend no método cadastrar
* da classe GrupoAdminFuncoesAdminServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 19:06:03
*
*/

require_once '../grupoadminfuncoesadmin/GrupoAdminFuncoesAdminServiceImpl.php';
require_once '../grupoadminfuncoesadmin/GrupoAdminFuncoesAdminDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new GrupoAdminFuncoesAdminDTO();

$dto->id = $_POST['id'];
$dto->idGrupoAdministracao = $_POST['idGrupoAdministracao'];
$dto->idFuncoesAdministrativas = $_POST['idFuncoesAdministrativas'];
$dto->descricao = $_POST['descricao'];
$dto->incrudCriar = $_POST['incrudCriar'];
$dto->incrudRecuperar = $_POST['incrudRecuperar'];
$dto->incrudAtualizar = $_POST['incrudAtualizar'];
$dto->incrudExcluir = $_POST['incrudExcluir'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new GrupoAdminFuncoesAdminServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
