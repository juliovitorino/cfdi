<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientRegistrarCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 1003;

$retorno = $csi->registrarSaldoCashbackCC($id_usuario);
var_dump($retorno);



?>
