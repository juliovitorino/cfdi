<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientpesquisarCartaoFull.php

require_once 'cartaoServiceImpl.php';

$id_cartao = 103;
$id_usuario = 1;

$csi = new CartaoServiceImpl();
$retorno = $csi->pesquisarCartaoFull($id_cartao, $id_usuario);
var_dump($retorno);

?>