<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/cartaomoverhistorico/clientCartaoMoverHistoricoInserir.php

require_once 'CartaoMoverHistoricoServiceImpl.php';
require_once 'CartaoMoverHistoricoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CartaoMoverHistoricoDTO();

//$dto->id = 1;
$dto->idCartao = 1000;
$dto->idUsuarioDoador = 1003;
$dto->idUsuarioReceptor = 1000;
/*
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();
*/

var_dump($dto);
$csi = new CartaoMoverHistoricoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
