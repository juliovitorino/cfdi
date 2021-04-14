<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientpesquisarCartaoFullCarimbo.php

require_once 'cartaoServiceImpl.php';

$carimbo = '9ed63be1192c4a291d86d86456c2ea9252d436c9';
$id_usuario = 1;

$csi = new CartaoServiceImpl();
$retorno = $csi->pesquisarCartaoFullCarimbo($carimbo, $id_usuario);
var_dump($retorno);

?>