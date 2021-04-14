<?php

// Importa dependências
require_once '../usuariostrocasenha/UsuarioTrocaSenhaHistoricoServiceImpl.php';

// Obtem dados do post

$usuarioid = $_POST['usuarioid'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$token = $_POST['token'];
/*
var_dump($usuarioid);
var_dump($pwd1);
var_dump($pwd1);
var_dump($token);
*/

$utshi = new UsuarioTrocaSenhaHistoricoServiceImpl();
$ok = $utshi->trocarSenhar($usuarioid, $pwd1, $pwd2, $token);

$retornoesperado = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;

// retorno OK é o default
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/senhaalteradasucesso.html";
</script>

</body>
</html>
EOD;

if($ok->msgcode == ConstantesMensagem::SENHAS_DIFERENTES){
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/senhasnaoconferem.html";
</script>

</body>
</html>
EOD;

} else if($ok->msgcode == ConstantesMensagem::TOKEN_INVALIDO) {
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/tokeninvalido.html";
</script>

</body>
</html>
EOD;

} else if($ok->msgcode == ConstantesMensagem::STATUS_CONTA_USUARIO_COM_PROBLEMAS){
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/contausuariostatuserro.html";
</script>

</body>
</html>
EOD;

}

// Aplica redirecionamento
echo $retorno


?>