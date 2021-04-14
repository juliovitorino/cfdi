<?php  
// http://localhost/cfdi/php/classes/cartao/clientCartaoFavorito.php

require_once 'cartaoServiceImpl.php';
$id_cartao = 100;
$id_usuario = 5;

$csi = new CartaoServiceImpl();
$retorno = $csi->atualizarCartaoFavoritos($id_cartao, $id_usuario);
var_dump($retorno);



?>