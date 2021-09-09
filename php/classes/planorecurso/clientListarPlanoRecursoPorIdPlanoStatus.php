

<?php 

// URL http://junta10.dsv:8080/cfdi/php/classes/planorecurso/clientListarPlanoRecursoPorIdPlanoStatus.php

require_once 'PlanoRecursoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new PlanoRecursoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$idplano = 1000;

// Imprime a 1a pagina
$retorno = $csi->listarPlanoRecursoPorIdplanoStatus($idplano,$status,1,10);
echo json_encode($retorno);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarPlanoRecursoPorIdplanoStatus($idplano,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarPlanoRecursoPorIdplanoStatus($idplano,$status,3,2);
var_dump($retorno);


?>
