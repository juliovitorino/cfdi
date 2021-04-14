<?php  

//http://localhost/cfdi/php/classes/campanha/clientCampanhaLike.php

require_once './campanhaServiceImpl.php';

$id_campanha = 4;
$id_usuario = 4;

$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizarTotalLike($id_campanha, $id_usuario, false);
var_dump($retorno);



?>