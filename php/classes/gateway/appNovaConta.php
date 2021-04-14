<?php
// http://elitefinanceira.com/cfdi/php/classes/gateway/appNovaConta.php?username=a&passwd=a&passwd2=a&email=a&id-cupom=a
// http://localhost/cfdi/php/classes/gateway/appNovaConta.php?username=a&passwd=a&passwd2=a&email=a&id-cupom=a

// Importa dependências
require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/ConstantesMensagem.php';

// Obtem dados do post
/*
$usuario = $_POST['username'];
$pwd = $_POST['passwd'];
$pwdConferencia = $_POST['passwd2'];
$email = $_POST['email'];
$cupom = $_POST['id-cupom'];
*/

/* Quando usar para teste */
$usuario = $_GET['username'];
$pwd = $_GET['passwd'];
$pwdConferencia = $_GET['passwd2'];
$email = $_GET['email'];
$cupom = $_GET['id-cupom'];



$dtousuario = new UsuarioDTO();
$dtousuario->apelido = $usuario;
$dtousuario->pwd = $pwd;
$dtousuario->email = $email; 
$dtousuario->cupom = $cupom;

// Cria e envia uma sessao de usuário usando um serviço de autenticação
$ss = new UsuarioServiceImpl();
$retorno = $ss->cadastrarNovaConta($dtousuario, VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));

// Aplica redirecionamento
echo json_encode($retorno);


?>