
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioComplemento.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioComplemento.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../usuariocomplemento/usuarioComplementoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new UsuarioComplementoServiceImpl();
$retorno = $csi->listarUsuarioComplemento($pag);

echo json_encode($retorno);


?>
