<?php

// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appApagarCampanhaCashbackResgatePix.php?tokenid=tk&id=tr

/**
*
* appApagarCampanhaCashbackResgatePix - Controlador para permitir acesso ao backend no método apagar()
* da classe CampanhaCashbackResgatePixServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 05/08/2021 15:11:48
*
*/

require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixServiceImpl.php';
require_once '../campanhacashbackresgatepix/CampanhaCashbackResgatePixDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new CampanhaCashbackResgatePixDTO();

$dto->id = $_GET['id'];
$csi = new CampanhaCashbackResgatePixServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->apagar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
