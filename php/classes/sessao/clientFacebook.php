<?php
session_start();

// Importa dependências
require_once '../sessao/SessaoServiceImpl.php';
require_once '../util/util.php';

// Cria e envia uma sessao de usuário usando um serviço de autenticação

$nome = "Julio Vitorino " . Util::getCodigo(10);
$email = "julio.vitorino" . Util::getCodigo(5) . "@gmail.com";
$idfcbk = Util::getCodigo(20);
$urlfoto = "no-user.png";
$versao = "1.4.7.5.20210824.0720";

$ss = new SessaoServiceImpl();
$ok = $ss->autenticarUsuarioFacebook($idfcbk, $nome, $email, $urlfoto, $versao);
var_dump($ok);

?>