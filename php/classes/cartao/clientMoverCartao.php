<?php  
// http://junta10.dsv:8080/cfdi/php/classes/cartao/clientMoverCartao.php

require_once 'cartaoServiceImpl.php';
$idusuarioDono = 1000;
$idusuarioDestino = 1003;
$idCartao = 1000;

$csi = new CartaoServiceImpl();
$retorno = $csi->moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
echo json_encode($retorno);



?>