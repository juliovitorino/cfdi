<?php 
ob_start();

//header('Content-type:application/json; charset=UTF-8');

require_once '../sessao/SessaoServiceImpl.php';
require_once '../dashboard/DashboardDTO.php';

include_once '../../inc/validarToken.php';

//TESTE EM HARDCODE
/*
$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
*/
//FIM TESTE

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

// obtem a sessao em ativa do usuario
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);

$retorno = new DashboardDTO();
$retorno->usuario = $usuariodto->apelido;
$retorno->urlfoto = $usuariodto->urlfoto;

echo json_encode($retorno);

ob_flush();
?>