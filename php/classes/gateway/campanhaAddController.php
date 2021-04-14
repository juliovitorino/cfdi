<?php

//url get para teste. passe um URL Enconder e mude de _POST para _POST
//localhost/cfd/php/classes/gateway/campanhaAddController.php?CAMP_TX_NOME=campanha1&CAMP_TX_EXPLICATIVO=textoexplicativo&CAMP_DT_INICIO=30/05/2019 10:51&CAMP_DT_TERMINO=31/05/2019 12:21&CAMP_NU_MAX_CARTAO=129&CAMP_NU_MIN_DELAY=00:15


ob_start();

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../campanha/campanhaServiceImpl.php';
require_once '../campanha/campanhaDTO.php';

include_once '../../inc/validarToken.php';

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

//TESTE pegue um qualquer na usuario_sessao
//$token = 'ff4cfd77db813693b39318fa032e49b145085e36';
//FIM TESTE
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);
echo "CampanhaAddController";

// Carrega dados do usuário 

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);
//var_dump($usuariodto);

// Monta o DTO a partir dos dados obtidos do cliente invocador
$campdto = new CampanhaDTO();
$campdto->id_usuario = $usuariodto->id;
$campdto->nome = $_POST['CAMP_TX_NOME'];
$campdto->fraseEfeito = $_POST['CAMP_TX_FRASE_EFEITO'];
$campdto->recompensa = $_POST['CAMP_TX_RECOMPENSA'];
$campdto->textoExplicativo = $_POST['CAMP_TX_EXPLICATIVO'];
$campdto->dataInicio = Util::ConverterDMYHM_to_YMDHMS($_POST['CAMP_DT_INICIO']);
$campdto->dataTermino = Util::ConverterDMYHM_to_YMDHMS($_POST['CAMP_DT_TERMINO']);
$campdto->maximoCartoes = $_POST['CAMP_NU_MAX_CARTAO'];
$campdto->minimoDelay = $_POST['CAMP_NU_MIN_DELAY'];

//var_dump($campdto);

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$csi = new CampanhaServiceImpl();
$retorno = $csi->cadastrar($campdto);

// retorna resultado
echo json_encode($retorno);

ob_flush();

?>