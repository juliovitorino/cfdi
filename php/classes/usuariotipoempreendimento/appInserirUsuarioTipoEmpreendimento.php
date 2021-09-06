<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirUsuarioTipoEmpreendimento.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioTipoEmpreendimento.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idUsuario=tr
&idTipoEmpreendimento=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioTipoEmpreendimento.php

/**
*
* appInserirUsuarioTipoEmpreendimento - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioTipoEmpreendimentoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 09:56:34
*
*/

require_once '../usuariotipoempreendimento/UsuarioTipoEmpreendimentoServiceImpl.php';
require_once '../usuariotipoempreendimento/UsuarioTipoEmpreendimentoDTO.php';
require_once '../util/util.php';
include_once '../../inc/validarTokenApp.php';

$dto = new UsuarioTipoEmpreendimentoDTO();

$dto->id = $_POST['id'];
$dto->idUsuario = $_POST['idUsuario'];
$dto->idTipoEmpreendimento = $_POST['idTipoEmpreendimento'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new UsuarioTipoEmpreendimentoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
