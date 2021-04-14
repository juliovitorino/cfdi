<?php  
ob_start();

// Importar dependências
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../estatisticafuncao/EstatisticaFuncaoServiceImpl.php';
require_once '../popularlistas/loadtableDTO.php';
require_once '../popularlistas/loadtableFactory.php';

include_once '../../inc/validarToken.php';

// Dados enviados via AJAX

$ltdto = new LoadTableDTO();
$ltdto->objeto = $_POST['objeto'];
$ltdto->modo = $_POST['modo'];
$ltdto->isload = $_POST['isload'];
$ltdto->target = $_POST['target'];
$ltdto->pid = $_POST['pid'];

// TESTE HARDCODE
/*
$ltdto = new LoadTableDTO();
$ltdto->objeto = '0';
$ltdto->modo = '0';
$ltdto->isload = '0';
$ltdto->target = 'bcklnknofollow';
$ltdto->pid = '0';
$token = 'c53b602a39074930c28c9f07b8188ecea97b9b5e';
*/
// FIM DO HARDCODE


//-- Obtem dados da sessão e do usuário
$ssi = new SessaoServiceImpl();
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID($sessaodto->usuario);

$ltf = LoadTableFactory::getInstance($usuariodto, $sessaodto, $ltdto);
echo $ltf->getStringJSON();

ob_flush();


?>