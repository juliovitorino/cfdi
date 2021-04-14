<?php

// http://elitefinanceira.com/cfdi/php/classes/gateway/loginAppController.php?username=admin&password=123456&keep=true&vrs=1.0.0
// http://localhost/cfdi/php/classes/gateway/loginAppController.php?username=admin&password=123456&keep=true&vrs=1.0.0

// Importa dependências
require_once '../sessao/SessaoDTO.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioDTO.php';

// Obtem dados do post
$usuario = $_GET['username'];
$pwd = $_GET['password'];
$keep = $_GET['keep'] == 'true' ? true : false;
$versao = $_GET['vrs'];

// Cria e envia uma sessao de usuário usando um serviço de autenticação
$ss = new SessaoServiceImpl();
$retorno = $ss->autenticarUsuarioApp($usuario, $pwd, $keep, $versao);

// Devolve resposta do backend ao App
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>