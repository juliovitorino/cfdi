<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirUsuarioCashback.php?tokenid=tk&vlMinimoResgate=tr&percentual=tr&obs=tr
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCashback.php?tokenid=tk&vlMinimoResgate=tr&percentual=tr&obs=tr


/*
Faça um Find/Replace em $_POST por $_POST e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&vlMinimoResgate=tr
&percentual=tr
&obs=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirUsuarioCashback.php

/**
*
* appInserirUsuarioCashback - Controlador para permitir acesso ao backend no método cadastrar
* da classe UsuarioCashbackServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2019 10:56:42
*
*/

require_once '../usuariocashback/UsuarioCashbackServiceImpl.php';
require_once '../usuariocashback/UsuarioCashbackDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new UsuarioCashbackDTO();
$dto->id_usuario = $sessaodto->usuariodto->id;
$dto->vlMinimoResgate = $_POST['vlMinimoResgate'];
$dto->percentual = $_POST['percentual'];
$dto->obs = $_POST['obs'];

$csi = new UsuarioCashbackServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>
