<?php

ob_start();

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../campanha/campanhaServiceImpl.php';

include_once '../../inc/validarToken.php';

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

//TESTE pegue um qualquer na usuario_sessao
//$token = 'ff4cfd77db813693b39318fa032e49b145085e36';
//FIM TESTE
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

// Carrega dados do usuário 

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);
//var_dump($usuariodto);

// Monta o DTO a partir dos dados obtidos do cliente invocador
$idcampanha = $_POST['idcampanha'];

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$csi = new CampanhaServiceImpl();
$retorno = $csi->autalizarStatusCampanha($idcampanha, ConstantesVariavel::STATUS_FILA);

// retorna resultado
echo json_encode($retorno);

ob_flush();

?>