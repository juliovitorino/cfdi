<?php 

// URL http://localhost/cfdi/php/classes/usuariopublicidade/clientListarUsuarioPublicidadePorUsuaIdStatus.php

require_once 'UsuarioPublicidadeServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioPublicidadeServiceImpl();
$statusAtivo = "'" . ConstantesVariavel::STATUS_ATIVO . "'";
$statusPendente = "'" . ConstantesVariavel::STATUS_PENDENTE . "'";
$status = "($statusAtivo,$statusPendente)";
$usuaid = 13;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioPublicidadePorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

?>
