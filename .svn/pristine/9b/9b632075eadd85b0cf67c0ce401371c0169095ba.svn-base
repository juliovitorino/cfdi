<?php  
ob_start();

// Importar dependências
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

include_once '../../inc/validarToken.php';

// Recupera dados do POST
$projeto = $_POST['pid'];

// HARDCODE TESTES
/*
$projeto = 1;
$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
*/

// HARDCODE TESTES

//-- Obtem nicho em função do projeto fornecido -- PRODUCAO
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);
$projetodto = $usi->buscarProjetoEspecifico($sessaodto->usuario, $projeto);

$nicho = $projetodto->nicho;

// Devolve objeto JSON
echo json_encode($projetodto);

ob_flush();
?>