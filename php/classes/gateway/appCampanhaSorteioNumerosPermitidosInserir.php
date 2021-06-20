<?php

/*
Faça um Find/Replace em $_GET por $_POST e use os parametros na URL para simular um GET na HttpRequest

http://elitefinanceira.com/cfdi/php/classes/gateway/appCampanhaSorteioNumerosPermitidosInserir.php?tokenid=3ac5758f3adfef9d30a1cf2d4bd107623cc6206a&casoid=1000

 */

/**
*
* appCampanhaSorteioNumerosPermitidosInserir - Gerar os tickets da campanha sorteio
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 16/06/2021 14:51:23
*
*/

require_once '../campanhasorteionumerospermitidos/CampanhaSorteioNumerosPermitidosServiceImpl.php';
require_once '../campanhasorteionumerospermitidos/CampanhaSorteioNumerosPermitidosDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';


$dto = new CampanhaSorteioNumerosPermitidosDTO();
$dto->id_caso = (int) $_GET['casoid'];

$csi = new CampanhaSorteioNumerosPermitidosServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
