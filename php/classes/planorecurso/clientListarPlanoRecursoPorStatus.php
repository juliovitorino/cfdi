<?php 

// URL http://localhost/cfdi/php/classes/planorecurso/clientListarPlanoRecursoPorStatus.php

require_once 'PlanoRecursoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new PlanoRecursoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarPlanoRecursoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarPlanoRecursoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarPlanoRecursoPorStatus($status,3,2);
var_dump($retorno);


?>
