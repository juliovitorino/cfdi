<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientListarCartoesUsuarioAtivos.php

require_once 'cartaoServiceImpl.php';

$idusuario = 5; // usuário existente dentro do banco de dados para teste unitário

$csi = new CartaoServiceImpl();
$retorno = $csi->listarCartoesFullInfoAtivos($idusuario);
var_dump($retorno);

?>