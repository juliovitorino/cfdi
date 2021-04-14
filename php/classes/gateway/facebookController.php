<?php  
ob_start();

// Importa arquivos necessários
require_once '../redessociais/RedesSociaisFactory.php';
require_once '../redessociais/ConstantesFactory.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../estatisticafuncao/EstatisticaFuncaoServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';

include_once '../../inc/validarToken.php';

// Recupera dados do POST
$nicho = $_POST['target'];

$fcbk = RedesSociaisFactory::getInstance(ConstantesFactory::CONCRETE_FACEBOOK, $nicho);
$fcbk->carregarTemplate();
echo $fcbk->getPost();

//************* Codigo padrão para registro de estatisticas **********
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);

// Preenche campos mutaveis da estatistica. Verifica se tem registro de estatistica
$tipoef = ConstantesEstatisticaFuncao::FUNCAO_POST_FACEBOOK;
$projetoidif = 0;

include_once '../../inc/registrarEstatisticaFuncao.php';
$efsi->incrementarQtdePorID($dtoef->id);
//*******FIM  :: Codigo padrão para registro de estatisticas **********

ob_flush();
?>