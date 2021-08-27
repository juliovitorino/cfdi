<?php 

// URL http://localhost/cfdi/php/classes/grupoadminfuncoesadmin/clientListarGrupoAdminFuncoesAdminPorStatus.php

require_once 'GrupoAdminFuncoesAdminServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new GrupoAdminFuncoesAdminServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminPorStatus($status,3,2);
var_dump($retorno);


?>
