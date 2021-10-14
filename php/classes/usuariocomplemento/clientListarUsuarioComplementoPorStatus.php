<?php 

// URL http://localhost/cfdi/php/classes/usuariocomplemento/clientListarUsuarioComplementoPorStatus.php

require_once 'usuarioComplementoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioComplementoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioComplementoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarUsuarioComplementoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarUsuarioComplementoPorStatus($status,3,2);
var_dump($retorno);


?>
