<?php  

//http://localhost/cfdi/php/classes/gateway/ativarNovaContaController.php?token=uF2YeLMil4Ej0XpSUC6Mzq4btNL1tbS2jmROwUHuQi48HZ06fIhqavuV8p9Fzumjv51L7wMnIMInGZ7QPj39S0wcS3zmEPKW0bSilO0QCjBiR8lcgwN76IeBkBeYpA

// importar dependencias
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

$token = $_GET['token'];

$usi = new UsuarioServiceImpl();
$ok = $usi->habilitarContaPorEmail($token);

if($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
// retorno sucesso

$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/ativado-com-sucesso.html";
</script>

</body>
</html>
EOD;
} else if ($ok->msgcode == ConstantesMensagem::CONTA_JA_ATIVADA){
// retorno problema
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/conta-ja-ativada.html";
</script>

</body>
</html>
EOD;

} else {
// retorno problema
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/ativacao-problema.html";
</script>

</body>
</html>
EOD;

}

// devolve a página de retorno
echo $retorno;


?>