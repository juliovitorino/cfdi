<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteioTicket.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteioTicket.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&iduscs=tr
&ticket=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCampanhaSorteioTicket.php

/**
*
* appInserirUsuarioCampanhaSorteioTicket - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioCampanhaSorteioTicketServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 10:37:39
*
*/

require_once '../usuariocampanhasorteioticket/UsuarioCampanhaSorteioTicketServiceImpl.php';
require_once '../usuariocampanhasorteioticket/UsuarioCampanhaSorteioTicketDTO.php';
require_once '../util/util.php';

$dto = new UsuarioCampanhaSorteioTicketDTO();

$dto->id = $_POST['id'];
$dto->iduscs = $_POST['iduscs'];
$dto->ticket = $_POST['ticket'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new UsuarioCampanhaSorteioTicketServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
