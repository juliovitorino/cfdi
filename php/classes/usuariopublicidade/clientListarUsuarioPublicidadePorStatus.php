<?php 

// URL http://localhost/cfdi/php/classes/usuariopublicidade/clientListarUsuarioPublicidadePorStatus.php

require_once 'UsuarioPublicidadeServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioPublicidadeServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioPublicidadePorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarUsuarioPublicidadePorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarUsuarioPublicidadePorStatus($status,3,2);
var_dump($retorno);


?>
