<?php 
// URL http://localhost/cfdi/php/classes/mkdlista/clientMkdListaInserir.php
// URL http://junta10.com/php/classes/mkdlista/clientMkdListaInserir.php

require_once 'MkdListaServiceImpl.php';
require_once 'MkdListaDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new MkdListaDTO();

$dto->id_mkd_campanha = 100; // Campanha pré existente
$dto->nome = Util::getCodigo(10);
$dto->email = 'paopao@junta10.com';

var_dump($dto);
$csi = new MkdListaServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
