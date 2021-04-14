<?php  
ob_start();

// Importar dependências
require_once '../keywordrelated/keywordRelatedServiceImpl.php';
require_once '../util/util.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

include_once '../../inc/validarToken.php';

// Obtem dados do post
$keywordparentid = $_POST['keywordparentid'];

//-- Obtem dados da sessão e do usuário
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

$ksi = new KeywordRelatedServiceImpl();
// TESTE HARDCODE
//$keywordparentid = 129;
// FIM DO HARDCODE
$retorno = $ksi->listarKeywordRelated($keywordparentid);	

// devolve resultado ao front-end
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

ob_flush();

?>