<?php 
// URL http://localhost/cfdi/php/classes/usuariopublicidade/clientUsuarioPublicidadeInserir.php

require_once 'UsuarioPublicidadeServiceImpl.php';
require_once 'UsuarioPublicidadeDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioPublicidadeDTO();

$dto->id_usuario = 22;
$dto->titulo = Util::getLoremIpsum() . Util::getCodigo(10);
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataInicio = Util::getNow();
$dto->dataTermino = Util::getNow();
$dto->vlNormal = rand(1,10000)/100;
$dto->vlPromo = rand(1,1000)/100;
$dto->observacao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataRemover = Util::getNow();
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();

var_dump($dto);
$csi = new UsuarioPublicidadeServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
