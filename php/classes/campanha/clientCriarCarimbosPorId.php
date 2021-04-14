<?php  

//http://localhost/cfdi/php/classes/campanha/clientCriarCarimbosPorId.php

require_once './campanhaServiceImpl.php';

$id_usuario = 22;
$id_campanha = 22;


$csi = new CampanhaServiceImpl();
$retorno = $csi->criarCampanhaPorParceiroCampanha($id_usuario, $id_campanha);
var_dump($retorno);



?>