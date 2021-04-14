<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientRealizarEntregaRecompensa.php

require_once 'cartaoServiceImpl.php';

$hash = '5198eabc397f8c5e913cf3959b49d0edcad6d318'; // Hash de resgate
$id_usuario = 4;

$csi = new CartaoServiceImpl();
$retorno = $csi->realizarEntregaRecompensa($hash, $id_usuario);
var_dump($retorno);

?>