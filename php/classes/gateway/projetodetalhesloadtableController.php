<?php
ob_start();

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

include_once '../../inc/validarToken.php';

// Obtem o projeto vai POST
$pid = $_POST['pid'];
$detalhe = $_POST['detalhe'];

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

//TESTE
/*
$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
$pid = 1;
$detalhe = 'projeto_item';
*/
//FIM TESTE


$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

// Carrega dados do usuário 
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);
//$usuariodto = $usi->pesquisarPorId(1);
//var_dump($usuariodto);

// Carrega o projeto especifico
$projeto = $usi->buscarProjetoEspecifico($usuariodto->id, $pid);

// Verifica de detalhe do projeto é para retornar
if ($detalhe === 'projeto_item') {
	$projeto->lst_itens = $usi->buscarTodosItens($pid);
} else if($detalhe === 'projeto_dor') {
	$projeto->lst_dores = $usi->buscarTodasDores($pid);
} else if($detalhe === 'projeto_bonus') {
	$projeto->lst_bonus = $usi->buscarTodosBonus($pid);
} else if($detalhe === 'projeto_beneficios') {
	$projeto->lst_beneficios = $usi->buscarTodosBeneficios($pid);
} else if($detalhe === 'projeto_tecnicas') {
	$projeto->lst_tecnicas = $usi->buscarTodasTecnicas($pid);
}
//var_dump($projeto);

// retorna resultado
echo json_encode($projeto);

ob_flush();
?>