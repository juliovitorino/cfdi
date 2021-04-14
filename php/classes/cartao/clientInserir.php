<?php  
// URL http://localhost/cfdi/php/classes/cfdi/clientInserir.php

require_once 'cfdiServiceImpl.php';
require_once 'cfdiDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CfdiDTO();

$dto->id_campanha = 1;
$dto->id_fiel = 1;
$dto->qrcode = Util::getCodigo(40);
$dto->modo = 'C';
$dto->status = 'A';

$csi = new CfdiServiceImpl();
$retorno = $csi->cadastrar($dto);
var_dump($retorno);



?>