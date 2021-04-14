<?php  
ob_start();

// Importar dependências
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../notificacao/NotificacaoServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

include_once '../../inc/validarToken.php';

// Dados enviados via AJAX
$usnoid = $_POST['usnoid'];

// TESTE HARDCODE
/*
$usbaid = 347;
$novostatus = ConstantesVariavel::STATUS_REALIZADO; // R
//$novostatus = ConstantesVariavel:: STATUS_REPORTAR_BUG; // B
*/
// FIM DO HARDCODE


//-- Obtem dados da sessão e do usuário
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

$nsi = new NotificacaoServiceImpl();
$retorno = $nsi->atualizarStatusNotificacao((integer) $usnoid, ConstantesVariavel::STATUS_REALIZADO);

// devolve resultado ao front-end
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

ob_flush();

?>