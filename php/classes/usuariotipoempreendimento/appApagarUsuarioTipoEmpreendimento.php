<?php

// URL http://junta10.dsv:8080/cfdi/php/classes/gateway/appApagarUsuarioTipoEmpreendimento.php?tokenid=tk&id=tr

/**
*
* appApagarUsuarioTipoEmpreendimento - Controlador para permitir acesso ao backend no método apagar()
* da classe UsuarioTipoEmpreendimento.php
* É uma camada visível para outros dispositivos e requisições
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 05/08/2021 15:11:48
*
*/

require_once '../usuariotipoempreendimento/UsuarioTipoEmpreendimentoServiceImpl.php';
require_once '../usuariotipoempreendimento/UsuarioTipoEmpreendimentoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new UsuarioTipoEmpreendimentoDTO();

$dto->id = $_GET['id'];
$csi = new UsuarioTipoEmpreendimentoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->apagar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>

