<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCartaoComentarios.php?tokenid=cb1e&campid=1&ispositivo=(3,4,5)&qtd=30
// URL http://localhost/cfdi/php/classes/gateway/appListarCartaoComentarios.php?tokenid=cb1e&campid=1&ispositivo=(3,4,5)&qtd=30

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$idcampanha = $_GET['campid'];
$isPositivo = $_GET['ispositivo'] == '(3,4,5)' ? true : false;
$qtdeComentarios = $_GET['qtd'] == '' ? 0 : (int) $_GET['qtd'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $csi->listarAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios);
echo json_encode($retorno);

?>