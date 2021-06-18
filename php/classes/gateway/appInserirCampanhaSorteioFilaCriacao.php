<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaSorteioFilaCriacao.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteioFilaCriacao.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&id_caso=tr
&qtLoteTicketCriar=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaSorteioFilaCriacao.php
// URL http://junta10.dsv/cfdi/php/classes/gateway/appInserirCampanhaSorteioFilaCriacao.php

/**
*
* appInserirCampanhaSorteioFilaCriacao - Controlador para permitir acesso ao backend no método cadastrar
* da classe CampanhaSorteioFilaCriacaoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 08:10:22
*
*/

require_once '../campanhasorteiofilacriacao/CampanhaSorteioFilaCriacaoServiceImpl.php';
require_once '../campanhasorteiofilacriacao/CampanhaSorteioFilaCriacaoDTO.php';
require_once '../util/util.php';

$dto = new CampanhaSorteioFilaCriacaoDTO();

$dto->id = $_POST['id'];
$dto->id_caso = $_POST['id_caso'];
$dto->qtLoteTicketCriar = $_POST['qtLoteTicketCriar'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new CampanhaSorteioFilaCriacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
