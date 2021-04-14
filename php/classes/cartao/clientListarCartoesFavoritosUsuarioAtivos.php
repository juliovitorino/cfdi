<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientListarCartoesFavoritosUsuarioAtivos.php

require_once 'cartaoServiceImpl.php';

$idusuario = 5; // usuário existente dentro do banco de dados para teste unitário

$csi = new CartaoServiceImpl();
$retorno = $csi->listarCartoesFullInfoFavoritosAtivos($idusuario);
var_dump($retorno);



?>