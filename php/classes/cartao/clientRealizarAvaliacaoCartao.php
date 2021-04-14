<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientRealizarAvaliacaoCartao.php

require_once 'cartaoServiceImpl.php';

$hash = 'fe132484d52996eddcbbe0aece83c11b9040dd2d'; // Hash de resgate
$id_usuario = 5;
$rating = '5';
$comentario = 'Foi uma excelente campanha ' . rand(1,10000000);

$csi = new CartaoServiceImpl();
$retorno = $csi->realizarAvaliacaoCartao($hash, $id_usuario, $rating, $comentario);
var_dump($retorno);

?>