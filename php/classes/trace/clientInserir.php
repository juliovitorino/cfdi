<?php  
// URL http://localhost/cfdi/php/classes/trace/clientInserir.php

require_once 'traceServiceImpl.php';
require_once 'traceDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new TraceDTO();

$dto->tipo = 'Tipo_' . $ts;
$dto->descricao = 'Lorem Ipsum ' . Util::getCodigo(40);

$csi = new TraceServiceImpl();
$retorno = $csi->cadastrar($dto);
var_dump($retorno);



?>