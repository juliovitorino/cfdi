<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteioNumerosPermitidos.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteioNumerosPermitidos.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&id_caso=tr
&nrTicketSorteio=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteioNumerosPermitidos.php

/**
*
* appInserirCampanhaSorteioNumerosPermitidos - Controlador para permitir acesso ao backend no método cadastrar
* da classe CampanhaSorteioNumerosPermitidosServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 18:03:34
*
*/

require_once '../campanhasorteionumerospermitidos/CampanhaSorteioNumerosPermitidosServiceImpl.php';
require_once '../campanhasorteionumerospermitidos/CampanhaSorteioNumerosPermitidosDTO.php';
require_once '../util/util.php';

$dto = new CampanhaSorteioNumerosPermitidosDTO();

$dto->id = $_POST['id'];
$dto->id_caso = $_POST['id_caso'];
$dto->nrTicketSorteio = $_POST['nrTicketSorteio'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new CampanhaSorteioNumerosPermitidosServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
