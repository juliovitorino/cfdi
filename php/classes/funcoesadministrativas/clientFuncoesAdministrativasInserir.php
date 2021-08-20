<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/seglog/funcoesadministrativas/clientFuncoesAdministrativasInserir.php

require_once 'FuncoesAdministrativasServiceImpl.php';
require_once 'FuncoesAdministrativasDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FuncoesAdministrativasDTO();

$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new FuncoesAdministrativasServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
