<?php 

// URL http://localhost/cfdi/php/classes/usuarionotificacao/clientListarUsuarioNotificacaoPorStatus.php

require_once 'UsuarioNotificacaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioNotificacaoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioNotificacaoPorStatus($status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarUsuarioNotificacaoPorStatus($status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarUsuarioNotificacaoPorStatus($status,3,2);
var_dump($retorno);


?>
