<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCartaoMoverHistorico.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCartaoMoverHistorico.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idCartao=tr
&idUsuarioDoador=tr
&idUsuarioReceptor=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCartaoMoverHistorico.php

/**
*
* appInserirCartaoMoverHistorico - Controlador para permitir acesso ao backend no método cadastrar
* da classe CartaoMoverHistoricoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 24/07/2021 10:20:31
*
*/

require_once '../cartaomoverhistorico/CartaoMoverHistoricoServiceImpl.php';
require_once '../cartaomoverhistorico/CartaoMoverHistoricoDTO.php';
require_once '../util/util.php';

$dto = new CartaoMoverHistoricoDTO();

$dto->id = $_POST['id'];
$dto->idCartao = $_POST['idCartao'];
$dto->idUsuarioDoador = $_POST['idUsuarioDoador'];
$dto->idUsuarioReceptor = $_POST['idUsuarioReceptor'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new CartaoMoverHistoricoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
