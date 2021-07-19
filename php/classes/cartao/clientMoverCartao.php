<?php  
// http://junta10.dsv:8080/cfdi/php/classes/cartao/clientMoverCartao.php

require_once 'cartaoServiceImpl.php';
$idusuarioDono = 10;
$idusuarioDestino = 20;
$idCartao = 1;

$csi = new CartaoServiceImpl();
$retorno = $csi->moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
var_dump($retorno);



?>