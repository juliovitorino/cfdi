<?php 
// URL http://elitefinanceira.com/cfdi/php/classes/usuariopublicidade/clientAtualizarImagem.php
// URL http://localhost/cfdi/php/classes/usuariopublicidade/clientAtualizarImagem.php

require_once 'UsuarioPublicidadeServiceImpl.php';
require_once 'UsuarioPublicidadeDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$uspuid = 1004;
$name = "http://" . Util::getCodigo(10) . '.' . Util::getLoremIpsum() ;

$csi = new UsuarioPublicidadeServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->atualizarImagem($uspuid, $name);
var_dump($retorno);
?>
