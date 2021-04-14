<?php  
ob_start();

// Importar dependências
require_once '../projetoserp/projetoSERPServiceImpl.php';
require_once '../util/util.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

include_once '../../inc/validarToken.php';

// obtem dados POST
$projetoid = $_POST['projetoid'];

//-- Obtem dados da sessão e do usuário
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

// TESTE HARDCODE
//$projetoid = 141;
// FIM DO HARDCODE
$ksi = new ProjetoSERPServiceImpl();
$retorno = $ksi->listarSERPAnalitico((integer) $projetoid);

// devolve resultado ao front-end
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

ob_flush();

?>