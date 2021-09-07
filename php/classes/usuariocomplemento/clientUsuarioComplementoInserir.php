<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/usuariocomplemento/clientUsuarioComplementoInserir.php

require_once 'UsuarioComplementoServiceImpl.php';
require_once 'UsuarioComplementoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioComplementoDTO();

//$dto->id = 1;
$dto->idUsuario = 1000;
/*
$dto->ddd = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->telefone = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->nomeReceitaFederal = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->nomeResponsavel = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlsite = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlFacebook = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlInstagram = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlPinterest = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlSkype = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlTwitter = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlFacetime = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlResponsavel = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlFoto2 = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlFoto3 = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->descLivre = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();
*/

var_dump($dto);
$csi = new UsuarioComplementoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

























































































































































