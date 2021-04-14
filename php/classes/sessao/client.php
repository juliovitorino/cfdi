<?php
session_start();

// URL localhost/cfdi/php/classes/sessao/client.php

// Importa dependências
require_once '../sessao/SessaoServiceImpl.php';

// Cria e envia uma sessao de usuário usando um serviço de autenticação

$pwd = "1";
$usuario = "fiel";

$ss = new SessaoServiceImpl();
$retorno = $ss->autenticarUsuario($usuario, $pwd);
var_dump($retorno);

?>