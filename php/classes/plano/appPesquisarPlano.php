<?php

// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appPesquisarPlano.php?tokenid=94ff924c950e30271f2005c3018009e7f5f44d8d&id=1000

/**
*
* appPesquisarPlano - Controlador para permitir acesso ao backend no método pesquisarPorID()
* da classe Plano
* É uma camada visível para outros dispositivos e requisições
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 05/08/2021 15:11:48
*
*/

require_once '../plano/PlanoServiceImpl.php';
require_once '../plano/PlanoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$id = $_GET['id'];

include_once '../../inc/validarTokenApp.php';

$dto = new PlanoDTO();

$csi = new PlanoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->pesquisarPorID($id);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
