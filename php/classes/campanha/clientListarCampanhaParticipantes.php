<?php  

// URL http://elitefinanceira.com/cfdi/php/classes/campanha/clientListarCampanhaParticipantes.php
// URL http://localhost/cfdi/php/classes/campanha/clientListarCampanhaParticipantes.php
require_once 'campanhaServiceImpl.php';

$id_campanha=100; //3; //100;
$id_usuario=99;
$pag=1;

$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasParticipantes($id_campanha, $id_usuario, $pag);
//var_dump($retorno);

echo json_encode($retorno);



?>