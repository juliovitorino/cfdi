<?php  
// http://localhost/cfdi/php/classes/campanha/clientAtualizarStar.php

require_once 'campanhaServiceImpl.php';
$id_campanha = 3;
$star = 5;
$id_usuario = 4;

$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizarTotalStar($id_campanha, $id_usuario, $star);
var_dump($retorno);



?>