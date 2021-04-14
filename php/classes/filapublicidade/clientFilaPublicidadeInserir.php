<?php 
// URL http://localhost/cfdi/php/classes/filapublicidade/clientFilaPublicidadeInserir.php

require_once 'FilaPublicidadeServiceImpl.php';
require_once 'FilaPublicidadeDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FilaPublicidadeDTO();

$dto->id = 1;
$dto->id_usua_public = 1;
$dto->id_usuario = 1;
$dto->id_job = 1;
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();


var_dump($dto);
$csi = new FilaPublicidadeServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
