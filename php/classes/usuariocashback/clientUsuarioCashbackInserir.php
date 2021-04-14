<?php 
// URL http://localhost/cfdi/php/classes/usuariocashback/clientUsuarioCashbackInserir.php

require_once 'UsuarioCashbackServiceImpl.php';
require_once 'UsuarioCashbackDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioCashbackDTO();

$dto->id_usuario = 9; //4; //762; //9;
$dto->vlMinimoResgate = rand(1000,2000)/100;
$dto->percentual = rand(1,100)/10;
$dto->obs = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new UsuarioCashbackServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
