<?php
session_start();

// URL localhost/cfdi/php/classes/sessao/clientApp.php

// Importa dependências
require_once '../sessao/SessaoServiceImpl.php';

// Cria e envia uma sessao de usuário usando um serviço de autenticação

$pwd = "1";
$usuario = "fiel";

$ss = new SessaoServiceImpl();
$retorno = $ss->autenticarUsuarioApp($usuario, $pwd, true);
var_dump($retorno);

?>