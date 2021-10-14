<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/plano/clientPlanoInserir.php

require_once 'PlanoServiceImpl.php';
require_once 'PlanoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new PlanoDTO();

$dto->nome = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->permissao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->valor = floatval(Util::getCodigoNumerico(2) . "." . Util::getCodigoNumerico(2));
$dto->tipo = "PLA";


var_dump($dto);
$csi = new PlanoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
