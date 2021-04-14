<?php  

// importar dependencias
require_once '../mkdlista/MkdListaServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

$token = $_GET['token'];

$usi = new MkdListaServiceImpl();
$ok = $usi->ativarNovoLead($token);

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