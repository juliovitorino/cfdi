<?php 
// URL http://localhost/cfdi/php/classes/filaqrcodependenteproduzir/clientFilaQRCodePendenteProduzirInserir.php

require_once 'FilaQRCodePendenteProduzirServiceImpl.php';
require_once 'FilaQRCodePendenteProduzirDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FilaQRCodePendenteProduzirDTO();

$dto->id_campanha = 19;
$dto->id_usuario = 22;
$dto->qtde = rand(100,1000);

var_dump($dto);
$csi = new FilaQRCodePendenteProduzirServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
var_dump($retorno);
?>
