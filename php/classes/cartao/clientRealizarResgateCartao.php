<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientRealizarResgateCartao.php

require_once 'cartaoServiceImpl.php';

$hash = '8c47f368678ba39dc3e074102b60c526c83d5687'; // Hash de resgate

$csi = new CartaoServiceImpl();
$retorno = $csi->realizarResgateCartao($hash);
var_dump($retorno);

?>