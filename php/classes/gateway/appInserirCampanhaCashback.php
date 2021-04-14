<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaCashback.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaCashback.php


 /*
Faça um Find/Replace em $_POST por $_POST e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&id_campanha=tr
&id_usuario=tr
&titulo=tr
&descricao=tr
&vlMinimoResgate=tr
&percentual=tr
#VALUE!
&obs=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaCashback.php

/**
*
* appInserirCampanhaCashback - Controlador para permitir acesso ao backend no método cadastrar
* da classe CampanhaCashbackServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 02/09/2019 13:06:29
*
*/

require_once '../campanhacashback/CampanhaCashbackServiceImpl.php';
require_once '../campanhacashback/CampanhaCashbackDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new CampanhaCashbackDTO();

$dto->id_campanha = $_POST['id_campanha'];
$dto->id_usuario = $sessaodto->usuariodto->id;
$dto->titulo = $_POST['titulo'];
$dto->descricao = $_POST['descricao'];
$dto->percentual = $_POST['percentual'];
$dto->obs = $_POST['obs'];
$dto->dataTermino = Util::DMYHMiS_to_MySQLDate($_POST['dataTermino']);

$csi = new CampanhaCashbackServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
