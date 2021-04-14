<?php
// Inicia uma sessão no servidor
//if(!isset($_SESSION)){
//	session_start();
//}

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appFacebookAutenticacao.php?fcbkid=cb1&email=julio.vitorino@gmail.com&nome=julioCV&fotourl=minhafoto.png
// URL http://localhost/cfdi/php/classes/gateway/appFacebookAutenticacao.php?fcbkid=cb1&email=julio.vitorino@gmail.com&nome=julioCV&fotourl=minhafoto.png



// Importa dependências
require_once '../sessao/SessaoDTO.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../usuarios/UsuarioDTO.php';

// Obtem dados do post
$fcbkid = $_POST['fcbkid'];
$email = $_POST['email'];
$nome = $_POST['nome']; 
$urlfoto = $_POST['fotourl']; 
$versao = $_POST['versao']; 

/*'
var_dump($nome);
var_dump($email);
var_dump($fcbkid);
var_dump($urlfoto);
*/

// Cria e envia uma sessao de usuário usando um serviço de autenticação
$ss = new SessaoServiceImpl();
$retorno = $ss->autenticarUsuarioFacebook($fcbkid, $nome, $email, $urlfoto, $versao);


// Aplica redirecionamento
echo json_encode($retorno);

?>