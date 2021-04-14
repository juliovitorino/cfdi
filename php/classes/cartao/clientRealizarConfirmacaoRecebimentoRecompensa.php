<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientRealizarConfirmacaoRecebimentoRecompensa.php

require_once 'cartaoServiceImpl.php';

$hash = '5198eabc397f8c5e913cf3959b49d0edcad6d318'; // Hash de resgate
$id_usuario = 1;

$csi = new CartaoServiceImpl();
$retorno = $csi->realizarConfirmacaoRecebimentoRecompensa($hash, $id_usuario);
var_dump($retorno);

?>