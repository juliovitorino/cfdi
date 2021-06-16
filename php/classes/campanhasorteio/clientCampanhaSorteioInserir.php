<?php 
// URL http://junta10.dsv/cfdi/php/classes/campanhasorteio/clientCampanhaSorteioInserir.php

require_once 'CampanhaSorteioServiceImpl.php';
require_once 'CampanhaSorteioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaSorteioDTO();

$dto->id_campanha = 1000;
$dto->nome = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlRegulamento = "http://junta10.com/"  . Util::getCodigo(10);
$dto->premio = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataComecoSorteio = '2019-08-24 17:30:31';
$dto->dataFimSorteio = '2019-08-24 17:30:31';
$dto->maxTickets = 20000;


$csi = new CampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
