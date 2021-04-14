<?php  

// URL http://localhost/cfdi/php/classes/campanha/clientListarCampanhas.php
require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new campanhaDTO();

$dto->id_usuario = 4;

$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasUsuario($dto->id_usuario);
var_dump($retorno);



?>