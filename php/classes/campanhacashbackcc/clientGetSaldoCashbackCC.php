<?php 

// URL http://elitefinanceira.com/cfdi/php/classes/campanhacashbackcc/clientGetSaldoCashbackCC.php?idcredor=1000

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = (int) $_GET['idcredor']; // 0 = hoje; 7= 7 dias e assim por diante

$retorno = $csi->getSaldoCashbackCC($id_usuario);
var_dump($retorno);
echo json_encode($retorno);



?>
