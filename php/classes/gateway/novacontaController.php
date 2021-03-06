<?php
// http://localhost/cfdi/php/classes/gateway/novacontaController.php

ob_start();

// Importa dependências
require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/ConstantesMensagem.php';

// Obtem dados do post
$usuario = $_POST['username'];
$pwd = $_POST['passwd'];
$pwdConferencia = $_POST['passwd2'];
$email = $_POST['email'];
$cupom = $_POST['id-cupom'];

$dtousuario = new UsuarioDTO();
$dtousuario->apelido = $usuario;
$dtousuario->pwd = $pwd;
$dtousuario->email = $email; 
$dtousuario->cupom = $cupom;

// Cria e envia uma sessao de usuário usando um serviço de autenticação
$ss = new UsuarioServiceImpl();
$ok = $ss->cadastrarNovaConta($dtousuario, VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));

//exit(0);

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
window.location.href="../../../light/sign_up.html?plano=$cupom";
</script>

</body>
</html>
EOD;

// Troca o conteúdo do retorno
if ($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
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

} else if ($ok->msgcode == ConstantesMensagem::EMAIL_EM_USO_POR_OUTRO_USUARIO) {
	// Cria retorno para 'plingo' iniciando com dashboard
	$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/conta-ja-existe.html";
</script>

</body>
</html>
EOD;

}

// Aplica redirecionamento
echo $retorno;

ob_flush();
?>