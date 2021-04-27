<?php
session_start();

// Importa dependências
require_once '../sessao/SessaoServiceImpl.php';

// Cria e envia uma sessao de usuário usando um serviço de autenticação

$nome = "Julio Vitorino";
$email = "julio.vitorino@gmail.com";
$idfcbk = '109441640377672115445';
$urlfoto = "no-user.png";
$versao = "1.0.0.20191007.0744";

$ss = new SessaoServiceImpl();
$ok = $ss->autenticarUsuarioFacebook($idfcbk, $nome, $email, $urlfoto, $versao);
var_dump($ok);

?>