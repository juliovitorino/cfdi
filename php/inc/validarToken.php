<?php

// importar dependências 
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../sessao/ConstantesSessao.php';

$token = "";

//echo "entrei validarToken.php<br>";
// Verifica se precisa iniciar uma sessão

if(!isset($_SESSION)){
    session_start();
} else {
	$obj = $_SESSION[ConstantesSessao::SESSAO_TOKEN];
	$token = $obj;
}

// HARDCODE PARA TESTES
//$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';

// Solicita de servicos de sessao
$sbi = new SessaoServiceImpl();

if (!$sbi->autenticarTokenSessao($token)){
	$_SESSION = [];

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

	echo $retorno;
	exit(0);
} 

$sbi = NULL;
//echo "VALIDAÇÃO OK";
?>