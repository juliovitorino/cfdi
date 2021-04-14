<?php

ob_start();

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../campanha/campanhaServiceImpl.php';

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

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$csi = new CampanhaServiceImpl();
$lst = $csi->listarCampanhasUsuario($usuariodto->id);

// retorna resultado
echo json_encode($lst);

ob_flush();

?>