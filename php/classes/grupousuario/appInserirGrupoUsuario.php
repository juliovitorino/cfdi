<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirGrupoUsuario.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoUsuario.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idgrad=tr
&id_usuario=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoUsuario.php

/**
*
* appInserirGrupoUsuario - Controlador para permitir acesso ao backend no método cadastrar
* da classe GrupoUsuarioServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/08/2021 17:02:50
*
*/

require_once '../grupousuario/GrupoUsuarioServiceImpl.php';
require_once '../grupousuario/GrupoUsuarioDTO.php';
require_once '../util/util.php';

include_once '../../inc/validarTokenApp.php';

$dto = new GrupoUsuarioDTO();

$dto->id = $_POST['id'];
$dto->idgrad = $_POST['idgrad'];
$dto->id_usuario = $_POST['id_usuario'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new GrupoUsuarioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
