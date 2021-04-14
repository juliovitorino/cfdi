<?php  
// URL http://localhost/cfdi/php/classes/campanha/clientExcluirCampanha.php

require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new campanhaDTO();
$dto->id = 3;
$dto->id_usuario = 4;

$csi = new CampanhaServiceImpl();
$retorno = $csi->apagar($dto);
var_dump($retorno);



?>