<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientGetSaldoCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 0; // 0 = hoje; 7= 7 dias e assim por diante

$retorno = $csi->getSaldoCashbackCC($id_usuario);
var_dump($retorno);



?>
