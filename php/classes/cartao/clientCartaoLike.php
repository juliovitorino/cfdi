<?php  
// http://localhost/cfdi/php/classes/cartao/clientCartaoLike.php

require_once 'cartaoServiceImpl.php';
$id_cartao = 100;
$id_usuario = 5;

$csi = new CartaoServiceImpl();
$retorno = $csi->atualizarCartaoLike($id_cartao, $id_usuario);
var_dump($retorno);



?>