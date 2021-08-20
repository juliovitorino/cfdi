
<?php 

// URL http://localhost/cfdi/php/classes/grupoadminfuncoesadminusuario/clientListarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus.php

require_once 'GrupoAdminFuncoesAdminUsuarioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new GrupoAdminFuncoesAdminUsuarioServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1;

// Imprime a 1a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);


?>
