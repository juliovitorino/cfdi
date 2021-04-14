<?php  
ob_start();

// Importar dependências
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../usuariobacklink/UsuarioBacklinkServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

include_once '../../inc/validarToken.php';

// Dados enviados via AJAX
$usbaid = $_POST['usbaid'];
$novostatus = $_POST['novostatus'];

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

$usbasi = new UsuarioBacklinkServiceImpl();
$retorno = $usbasi->atualizarStatus($usuariodto->id, $usbaid, $novostatus);

// Realiza um ajuste na mensagem de sucesso do frontend
if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
	if ($novostatus == ConstantesVariavel::STATUS_REALIZADO){
		$retorno->msgcode = ConstantesMensagem::BACKLINK_FOI_MARCADO_COMO_REALIADO;
	} else {
		$retorno->msgcode = ConstantesMensagem::BACKLINK_FOI_MARCADO_COMO_BUG;
	}
	$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
}

// devolve resultado ao front-end
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

ob_flush();

?>