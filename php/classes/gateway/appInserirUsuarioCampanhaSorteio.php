<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteio.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteio.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idUsuario=tr
&idCampanhaSorteio=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteio.php

/**
*
* appInserirUsuarioCampanhaSorteio - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioCampanhaSorteioServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 08:05:45
*
*/

require_once '../usuariocampanhasorteio/UsuarioCampanhaSorteioServiceImpl.php';
require_once '../usuariocampanhasorteio/UsuarioCampanhaSorteioDTO.php';
require_once '../util/util.php';

$dto = new UsuarioCampanhaSorteioDTO();

$dto->id = $_POST['id'];
$dto->idUsuario = $_POST['idUsuario'];
$dto->idCampanhaSorteio = $_POST['idCampanhaSorteio'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new UsuarioCampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
