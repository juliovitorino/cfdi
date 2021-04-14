<?php  
ob_start();

// Importar dependências
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../usuarios/ProjetoDTO.php';
require_once '../debugger/Debugger.php';
require_once '../usuariosplanos/PlanoUsuarioServiceImpl.php';

include_once '../../inc/validarToken.php';


// Recupera dados do POST e popula ProjetoDTO parcialmente

$pdto = new ProjetoDTO();
$pdto->id = $_POST['pid'];
$pdto->projeto = $_POST['projeto'];
$pdto->email_contato = $_POST['email_contato'];
$pdto->palavra_chave_exata = $_POST['palavra_chave_exata'];
$pdto->headline = $_POST['headline'];
$pdto->nicho = $_POST['nicho'];
$pdto->plataforma = $_POST['plataforma'];
$pdto->url_minisite = $_POST['url_minisite'];
$pdto->nome_produto = $_POST['nome_produto'];
$pdto->desc_produto = $_POST['desc_produto'];
$pdto->tipo_produto = $_POST['tipo_produto'];
$pdto->preco_produto = floatval($_POST['preco_produto']);
$pdto->hotlink_pv = $_POST['hotlink_pv'];
$pdto->hotlink_chkout = $_POST['hotlink_chkout'];
$pdto->autoridade = $_POST['autoridade'];
$pdto->breve_desc_autoridade = $_POST['breve_desc_autoridade'];

$modo = $_POST['modo'];

// HARDCODE TESTES
/*
$token = 'dd7b6223ee1862af128a3832c0743427d096ecc0';
$pdto = new ProjetoDTO();
$pdto->id = 141;
$pdto->projeto = 'lorem ipsum';
$pdto->email_contato = 'contato@qualquercoisa.com.br';
$pdto->palavra_chave_exata = 'como fazer seox';
$pdto->headline = 'minha headline';
$pdto->nicho = 'marketing-digital';
$pdto->plataforma = 'HOTMART';
$pdto->nome_produto = 'produto qualquer';
$pdto->desc_produto = 'descricao qualquer';
$pdto->tipo_produto = 'Treinamento';
$pdto->preco_produto = 497;
$pdto->url_minisite = 'httpd://go.hotmart.com?id87346286r';
$pdto->hotlink_pv = 'httpd://go.hotmart.com?id87346286r';
$pdto->hotlink_chkout = 'httpd://go.chk.hotmart.com?id87346286r';
$pdto->autoridade = 'Eu';
$pdto->breve_desc_autoridade = 'Sou foda';
//$modo = "add";
//$modo = "edit";
//$modo = "inserir-projeto-dores";
//$modo = "deletar-projeto-item";
//$pdto->projeto = 'projeto-tecnicas';
//$pdto->projeto = 'projeto-dores';
*/
// HARDCODE TESTES

/*
var_dump($pdto->id);
var_dump($modo);
var_dump($pdto->desc_produto);
var_dump($pdto->projeto);
*/
//-- Obtem nicho em função do projeto fornecido -- PRODUCAO
if($modo == "add") 
{
	$ssi = new SessaoServiceImpl();
	$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
	$usi = new UsuarioServiceImpl();
	$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

	// Coloca o ID do usuario ativo no DTO
	$pdto->usuarioid = $usuariodto->id;
	$pdto->status = "A";
	Debugger::debug($pdto, Debugger::DEBUG);

	// Verifica a permissão 
	$pusi = new PlanoUsuarioServiceImpl();
	$res = $pusi->verificarPermissaoPlano($usuariodto->id, ConstantesPlano::PERM_PROJETO);
	Debugger::debug($res, Debugger::DEBUG);

	if (
		($res->msgcode == ConstantesMensagem::PERMISSAO_CONCEDIDA_FACTORY) ||
		($res->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
	) {
		$ok = $usi->cadastrarProjeto($pdto);
	}

	// devolve resultado ao front-end no formato JSON
	echo json_encode($res, JSON_UNESCAPED_UNICODE);

} else if($modo == "edit") {
	$ssi = new SessaoServiceImpl();
	$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
	$usi = new UsuarioServiceImpl();
	$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

	// Coloca o ID do usuario ativo no DTO
	$pdto->usuarioid = $usuariodto->id;
	//var_dump($pdto);

	$ok = $usi->atualizarProjeto($pdto);

	// Retorna ao front-end
	if (!is_null($ok))
	{
		echo $ok->msgcode . ':' . $ok->msgcodeString;
	} else {
		echo "Nao  foi";

	}
	

} else if( 
			($modo == "deletar-projeto-item") || 
			($modo == "deletar-projeto-dores") || 
			($modo == "deletar-projeto-bonus") || 
			($modo == "deletar-projeto-beneficios") || 
			($modo == "deletar-projeto-tecnicas")
		)
{
	$ssi = new SessaoServiceImpl();
	$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
	$usi = new UsuarioServiceImpl();
	$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

	// Coloca o ID do usuario ativo no DTO
	$pdto->usuarioid = $usuariodto->id;

	$ok = $usi->apagarProjetoItem($pdto->id, $pdto->projeto);

	// Retorna ao front-end
	if (!is_null($ok))
	{
		echo $ok->msgcode . ':' . $ok->msgcodeString;
	} else {
		echo "Nao  foi";

	}
	

} else if( 
			($modo == "inserir-projeto-item") || 
			($modo == "inserir-projeto-dores") || 
			($modo == "inserir-projeto-bonus") || 
			($modo == "inserir-projeto-beneficios") || 
			($modo == "inserir-projeto-tecnicas")
		)
{
	$ssi = new SessaoServiceImpl();
	$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
	$usi = new UsuarioServiceImpl();
	$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

	// Coloca o ID do usuario ativo no DTO
	$pdto->usuarioid = $usuariodto->id;

	$ok = $usi->cadastrarProjetoItem($pdto->id, $pdto->desc_produto, $pdto->projeto);

	// Retorna ao front-end
	if (!is_null($ok))
	{
		echo $ok->msgcode . ':' . $ok->msgcodeString;
	} else {
		echo "Nao  foi";

	}
	

}

ob_flush();
?>