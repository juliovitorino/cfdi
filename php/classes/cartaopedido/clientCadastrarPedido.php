<?php 
// URL http://localhost/cfdi/php/classes/cartaopedido/clientCadastrarPedido.php

require_once 'CartaoPedidoServiceImpl.php';
require_once 'CartaoPedidoDTO.php';
require_once '../util/util.php';

$idplano = 1;

$dto = new CartaoPedidoDTO();
$dto->id_campanha = 1;
$dto->qtde = 1;

var_dump($dto);
$csi = new CartaoPedidoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrarPedido($idplano, $dto);
var_dump($retorno);
?>
