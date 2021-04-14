<?php
// Inicia uma sessão no servidor
if(!isset($_SESSION)){
	session_start();
}


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

/*
var_dump($nome);
var_dump($email);
var_dump($fcbkid);
var_dump($urlfoto);
*/


/*
$nome = "Julio Vitorino";
$email = "julio.vitorino@gmail.com";
$idfcbk = '2278008755575813';
*/
// Cria e envia uma sessao de usuário usando um serviço de autenticação
$ss = new SessaoServiceImpl();
$ok = $ss->autenticarUsuarioFacebook($fcbkid, $nome, $email, $urlfoto);

/*
echo $ok->msgcode;
echo "<br>";
echo $ok->msgcodeString;
*/

// retorno negado é o default
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/login.html?status=denied";
</script>

</body>
</html>
EOD;

// Troca o conteúdo do retorno
if ($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
	$_SESSION[ConstantesSessao::SESSAO_TOKEN] = $ok->tokenid;
	$token = $ok->tokenid;

	// Cria retorno para 'plingo' iniciando com dashboard
	$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/index.php?target=dashboard-startup&sid=$token";
</script>

</body>
</html>
EOD;

} else if ($ok->msgcode == ConstantesMensagem::CONFIRMACAO_EMAIL_NOVA_CONTA_PENDENTE) {
	$_SESSION[ConstantesSessao::SESSAO_TOKEN] = $ok->tokenid;
	$token = $ok->tokenid;

	// Cria retorno para 'plingo' iniciando com dashboard
	$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/instrucoes.html";
</script>

</body>
</html>
EOD;

}

// Aplica redirecionamento
echo $retorno

?>