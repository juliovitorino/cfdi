<?php

// Importa dependências
require_once '../usuariostrocasenha/UsuarioTrocaSenhaHistoricoServiceImpl.php';

// Obtem dados do post
$email = $_POST['username'];
$utshi = new UsuarioTrocaSenhaHistoricoServiceImpl();
$ok = $utshi->esquecerSenha($email);

// retorno negado é o default
$retorno = <<<EOD
<!DOCTYPE html>
<html>
<body>
<script>
window.location.href="../../../light/instrucaotrocasenha.html";
</script>

</body>
</html>
EOD;


// Aplica redirecionamento
echo $retorno

?>