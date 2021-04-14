<?php
session_start();

// Importa dependências
require_once '../sessao/SessaoServiceImpl.php';

// Cria e envia uma sessao de usuário usando um serviço de autenticação

$nome = "Julio Vitorino";
$email = "julio.vitorino@gmail.com";
$idfcbk = '2278008755575813';

$ss = new SessaoServiceImpl();
$ok = $ss->autenticarUsuarioFacebook($idfcbk, $nome, $email);
var_dump($ok);

?>