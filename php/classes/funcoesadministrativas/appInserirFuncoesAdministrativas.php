<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirFuncoesAdministrativas.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirFuncoesAdministrativas.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&descricao=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirFuncoesAdministrativas.php

/**
*
* appInserirFuncoesAdministrativas - Controlador para permitir acesso ao backend no método cadastrar
* da classe FuncoesAdministrativasServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 15:09:15
*
*/

require_once '../funcoesadministrativas/FuncoesAdministrativasServiceImpl.php';
require_once '../funcoesadministrativas/FuncoesAdministrativasDTO.php';

include_once '../../inc/validarTokenApp.php';

$dto = new FuncoesAdministrativasDTO();

$dto->id = $_POST['id'];
$dto->descricao = $_POST['descricao'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new FuncoesAdministrativasServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
