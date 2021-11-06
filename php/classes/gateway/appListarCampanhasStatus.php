<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhasStatus.php?tokenid=xyz

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend

$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasPorStatus(ConstantesVariavel::STATUS_ATIVO);
echo json_encode($retorno);



?>