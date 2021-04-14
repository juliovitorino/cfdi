<?php 

// URL http://localhost/cfdi/php/classes/usuarionotificacao/clientListarUsuarioNotificacaoPorUsuaIdStatus.php

require_once 'UsuarioNotificacaoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new UsuarioNotificacaoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 4;

// Imprime a 1a pagina
$retorno = $csi->listarUsuarioNotificacaoPorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarUsuarioNotificacaoPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarUsuarioNotificacaoPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);

?>
