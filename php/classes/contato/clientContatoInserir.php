<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/contato/clientContatoInserir.php

require_once 'ContatoServiceImpl.php';
require_once 'ContatoDTO.php';
require_once 'ContatoConstantes.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new ContatoDTO();
$dto->nome = Util::getCodigo(40);
$dto->email = Util::getCodigo(10) . "@" . Util::getCodigo(6) . ".com.br";
$dto->origem = ContatoConstantes::ORIGEM_FALE_CONOSCO;
$dto->mensagem = Util::getLoremIpsum()  . Util::getCodigo(10);


var_dump($dto);
$csi = new ContatoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

