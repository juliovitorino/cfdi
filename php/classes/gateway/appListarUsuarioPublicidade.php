<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioPublicidade.php?tokenid=cb1&campid=1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioPublicidade.php?tokenid=cb1&campid=1&pag=1

// Importar dependencias
require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new UsuarioPublicidadeServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioPublicidadePorStatus($status,$pag);

echo json_encode($retorno);


?>
