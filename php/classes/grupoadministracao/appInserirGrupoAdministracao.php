<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirGrupoAdministracao.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdministracao.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&descricao=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirGrupoAdministracao.php

/**
*
* appInserirGrupoAdministracao - Controlador para permitir acesso ao backend no método cadastrar
* da classe GrupoAdministracaoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 16:02:22
*
*/

require_once '../grupoadministracao/GrupoAdministracaoServiceImpl.php';
require_once '../grupoadministracao/GrupoAdministracaoDTO.php';

include_once '../../inc/validarTokenApp.php';

$dto = new GrupoAdministracaoDTO();

$dto->id = $_POST['id'];
$dto->descricao = $_POST['descricao'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new GrupoAdministracaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
