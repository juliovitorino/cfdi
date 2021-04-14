<?php  
ob_start();

// Importar dependências
require_once '../maquinaminisite/ConstantesMaquinaMinisiteFactory.php';
require_once '../maquinaminisite/MaquinaMinisiteFactory.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../tags/TagsCommand.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../estatisticafuncao/EstatisticaFuncaoServiceImpl.php';
require_once '../usuariosplanos/PlanoUsuarioServiceImpl.php';

include_once '../../inc/validarToken.php';

// Recupera dados do POST
$projeto = $_POST['target'];
$lstsecao = array($_POST['s1'], $_POST['s2'],$_POST['s3'],$_POST['s4'],$_POST['s5'],$_POST['s6'],$_POST['s7'],$_POST['s8'],
$_POST['s9'],$_POST['s10'],$_POST['s11'],$_POST['s12'],$_POST['s13'],$_POST['s14'],$_POST['s15'],$_POST['s16'],
$_POST['s17'],$_POST['s18'],$_POST['s19'],$_POST['s20']);
// POST Fim

//array de teste e seus valores validos do frontend
//0
//ac-primeiro-paragrafo
//ac-promessa
//ac-autoridade
//ac-dor-problema
//ac-esperanca
//ac-storytelling
//ac-produto
//ac-depoimento
//ac-gerar-valor
//ac-procedimento-hotmart
//ac-procedimento-monetizze
//ac-procedimento-eduzz
//ac-gatilho-escassez-urgencia
//ac-gatilho-escassez-medo
//ac-produto-bonus
//ac-garantia
//ac-objecao-vale-a-pena
//ac-objecao-sem-dinheiro
//ac-objecao-nao-tenho-dinheiro
//ac-objecao-funciona
//ac-comunidade
//ac-calltoaction
//ac-calltoaction-chkout

// HARDCODE TESTES
/*
$projeto = 1; //FNO#1 
$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
$nicho = 'marketing-digital';
$lstsecao = array('ac-produto-bonus','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);
$projetodto = $usi->buscarProjetoEspecifico($sessaodto->usuario, $projeto);
var_dump($projetodto);
$projetodto->lst_bonus = $usi->buscarTodosBonus($projetodto->id);
*/
// HARDCODE TESTES



//-- Obtem nicho em função do projeto fornecido -- PRODUCAO

$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);
$projetodto = $usi->buscarProjetoEspecifico($sessaodto->usuario, $projeto);
$projetodto->lst_bonus = $usi->buscarTodosBonus($projetodto->id);
$projetodto->lst_itens = $usi->buscarTodosItens($projetodto->id);
$projetodto->lst_dores = $usi->buscarTodasDores($projetodto->id);
$projetodto->lst_beneficios = $usi->buscarTodosBeneficios($projetodto->id);
$projetodto->lst_tecnicas = $usi->buscarTodasTecnicas($projetodto->id);


$nicho = $projetodto->nicho;

//var_dump($sessaodto);
//var_dump($projetodto);

// variavel de retorno do minisite
$retorno = "";

// Verifica qual elemento será processado
foreach ($lstsecao as $value) {
	if ($value !== '0') {
		switch ($value) {
			case 'ac-primeiro-paragrafo':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_INTRODUCAO, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-promessa':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_PROMESSA, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-autoridade':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_AUTORIDADE, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-dor-problema':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_DOR, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-esperanca':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_ESPERANCA, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-storytelling':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_STORYTELLING, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-produto':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_PRODUTO, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-depoimento':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_DEPOIMENTO, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-gerar-valor':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_GERAR_VALOR, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-procedimento-hotmart':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_HOTMART, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-procedimento-monetizze':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_MONETIZZE, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-procedimento-eduzz':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_EDUZZ, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-gatilho-escassez-urgencia':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_GATILHO_ESCASSEZ_URGENCIA, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-gatilho-escassez-medo':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_GATILHO_ESCASSEZ_MEDO, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-produto-bonus':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_BONUS, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-garantia':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_GARANTIA, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-objecao-vale-a-pena':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_OBJECAO_VALE, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-objecao-funciona':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_OBJECAO_FUNCIONA, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-objecao-nao-tenho-dinheiro':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_OBJECAO_SEM_DINHEIRO, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-comunidade':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_COMUNIDADE, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-calltoaction':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_CALLTOACTION, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			case 'ac-calltoaction-chkout':
				$factory = MaquinaMiniSiteFactory::getInstance(ConstantesMaquinaMiniSiteFactory::CONCRETE_CALLTOACTION_CHECKOUT, $nicho); 
				$factory->carregarTemplate();
				$retorno = $retorno.$factory->getPost();
				break;
			default:
				# code...
				break;
		}
	}
}

// Verifica a permissão 
$pusi = new PlanoUsuarioServiceImpl();
$res = $pusi->verificarPermissaoPlano($sessaodto->usuario, ConstantesPlano::PERM_MINISITES);
Debugger::debug($res, Debugger::DEBUG);

// Retorno padrão da 
$seguefluxo = false;

if (
	($res->msgcode == ConstantesMensagem::PERMISSAO_CONCEDIDA_FACTORY) ||
	($res->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
) {
	$seguefluxo = true;
}


// Troca tags 
$o = New TagsCommand($usuariodto, $projetodto, $retorno);
$retorno = $o->getConteudo();

if (!$seguefluxo){
	$retorno = '<h3>' . $res->msgcodeString . '</h3>';
} else {
	//************* Codigo padrão para registro de estatisticas **********
	// Preenche campos mutaveis da estatistica. Verifica se tem registro de estatistica
	$tipoef = ConstantesEstatisticaFuncao::FUNCAO_MINISITE;
	$projetoidif = $projetodto->id;

	include_once '../../inc/registrarEstatisticaFuncao.php';
	$efsi->incrementarQtdePorID($dtoef->id);
	//*******FIM  :: Codigo padrão para registro de estatisticas **********

}

// retorna o minisite montado -- REMOVER COMENTARIO ABAIXO EM PRODUCAO
echo $retorno;

ob_flush();


?>