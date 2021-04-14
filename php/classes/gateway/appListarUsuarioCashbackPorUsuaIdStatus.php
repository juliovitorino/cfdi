<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioCashbackPorUsuaIdStatus.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarUsuarioCashbackPorUsuaIdStatus.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../usuariocashback/UsuarioCashbackServiceImpl.php';
require_once '../variavel/VariavelHelper.php';
require_once '../variavel/ConstantesVariavel.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new UsuarioCashbackServiceImpl();
$qtde = (int) VariavelHelper::getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT);
$retorno = $csi->listarUsuarioCashbackPorUsuaIdStatus($sessaodto->usuariodto->id, $status, $pag, $qtde, 1,1);

echo json_encode($retorno);


?>
