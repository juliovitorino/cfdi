<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientListarCartoesProcessoResgate.php

require_once 'cartaoServiceImpl.php';

$idusuario = 1; // usuário existente dentro do banco de dados para teste unitário

$csi = new CartaoServiceImpl();
$retorno = $csi->listarCartoesFullInfoProcessoResgate($idusuario);
var_dump($retorno);

?>