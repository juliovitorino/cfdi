<?php
ob_start();

// importar dependências
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

// Validação da session
include_once '../../inc/validarToken.php';

// HARDCODE PARA TESTES
//$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
//echo $token;
//echo "<br><br>";

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);

// Carrega dados do usuário 

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$projetos = $usi->buscarTodosProjetos($usuariodto->id);
$usuariodto->lst_projetos = $projetos;

// retorna resultado
echo json_encode($usuariodto);

ob_flush();
?>