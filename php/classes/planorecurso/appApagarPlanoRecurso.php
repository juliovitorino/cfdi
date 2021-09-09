<?php

// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appApagarPlanoRecurso.php?tokenid=tk&id=tr

/**
*
* appApagarPlanoRecurso - Controlador para permitir acesso ao backend no método apagar()
* da classe PlanoRecurso.php
* É uma camada visível para outros dispositivos e requisições
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 05/08/2021 15:11:48
*
*/

require_once '../planorecurso/PlanoRecursoServiceImpl.php';
require_once '../planorecurso/PlanoRecursoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new PlanoRecursoDTO();

$dto->id = $_GET['id'];
$csi = new PlanoRecursoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->apagar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
