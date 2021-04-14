<?php 

// URL http://localhost/cfdi/php/classes/usuariopublicidade/clientListarUsuarioPublicidadeProx24h.php

require_once 'UsuarioPublicidadeServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioPublicidadeServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioPublicidadeProx24h($usuaid,$status,1,2);
var_dump($retorno);


?>
