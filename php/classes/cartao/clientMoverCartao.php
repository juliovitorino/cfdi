<?php  
// http://junta10.dsv:8080/cfdi/php/classes/cartao/clientMoverCartao.php

require_once 'cartaoServiceImpl.php';
$idusuarioDono = 1003;
$idusuarioDestino = 1000;
$idCartao = 1108;

$csi = new CartaoServiceImpl();
$retorno = $csi->moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
echo json_encode($retorno);



?>