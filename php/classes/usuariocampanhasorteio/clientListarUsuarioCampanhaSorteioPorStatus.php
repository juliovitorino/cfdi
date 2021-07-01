<?php 

// URL http://localhost/cfdi/php/classes/usuariocampanhasorteio/clientListarUsuarioCampanhaSorteioPorStatus.php

require_once 'UsuarioCampanhaSorteioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioCampanhaSorteioServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioCampanhaSorteioPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarUsuarioCampanhaSorteioPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarUsuarioCampanhaSorteioPorStatus($status,3,2);
var_dump($retorno);


?>
