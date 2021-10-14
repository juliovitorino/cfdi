<?php  

//http://junta10.dsv:8080/cfdi/php/classes/campanha/clientCriarCarimbosPorId.php

require_once './campanhaServiceImpl.php';

$id_usuario = 1000;
$id_campanha = 1047;


$csi = new CampanhaServiceImpl();
$retorno = $csi->criarCampanhaPorParceiroCampanha($id_usuario, $id_campanha);
var_dump($retorno);



?>