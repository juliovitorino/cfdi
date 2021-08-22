<?php 

// URL http://junta10.dsv:8080/cfdi/php/classes/seglog/clientPesquisarSeglog.php

require_once 'SeglogServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new SeglogServiceImpl();
$funcao = "PROMOVER-RESGATE-PIX-EM-ANALISE-FINANCEIRO";
$funcao = "funcao-inexistente";
$usuaid = 1000;

// Imprime a 1a pagina
$retorno = $csi->pesquisarPorid_UsuarioFuncao($usuaid, $funcao);
echo json_encode($retorno);


?>
