<?php 

// URL http://localhost/cfdi/php/classes/usuarioavaliacao/clientListarUsuarioAvaliacaoPorStatus.php

require_once 'UsuarioAvaliacaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioAvaliacaoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioAvaliacaoPorStatus($status,1,2);
var_dump($retorno);

?>
