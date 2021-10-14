<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/recurso/clientRecursoInserir.php

require_once 'RecursoServiceImpl.php';
require_once 'RecursoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new RecursoDTO();

$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);


var_dump($dto);
$csi = new RecursoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

