<?php 
// URL http://localhost/cfdi/php/classes/cartaopedido/clientCartaoPedidoInserir.php

require_once 'CartaoPedidoServiceImpl.php';
require_once 'CartaoPedidoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CartaoPedidoDTO();

$dto->id = 1;
$dto->id_campanha = 1;
$dto->hashTransacao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->qtde = 1;
$dto->selos = 1;
$dto->vlrPedido = ${exemplo};
$dto->dataAutorizacao = '2019-08-24 17:30:31';
$dto->dataPgto = '2019-08-24 17:30:31';
$dto->vlrPgto = ${exemplo};
$dto->hashGtway = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new CartaoPedidoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
