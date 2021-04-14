<?php

ob_start();

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

include_once '../../inc/validarToken.php';

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

//TESTE
//$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
//FIM TESTE


$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

// Carrega dados do usuário 

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);

//$usuariodto = $usi->pesquisarPorId(1);
//var_dump($usuariodto);

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$projetos = $usi->buscarTodosProjetos($usuariodto->id);

//$projetos = $usi->buscarTodosProjetos(1);
$usuariodto->lst_projetos = $projetos;
//var_dump($usuariodto);

// retorna resultado
echo json_encode($usuariodto);

ob_flush();

?>