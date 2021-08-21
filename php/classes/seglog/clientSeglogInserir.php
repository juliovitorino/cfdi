<?php 
// URL http://localhost/cfdi/php/classes/seglog/clientSeglogInserir.php

require_once 'SeglogServiceImpl.php';
require_once 'SeglogDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new SeglogDTO();

$dto->id = 1;
$dto->idgafa = 1;
$dto->id_usuario = 1;
$dto->funcao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->incrudCriar = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->incrudRecuperar = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->incrudAtualizar = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->incrudExcluir = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();

var_dump($dto);
$csi = new SeglogServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
