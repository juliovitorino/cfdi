<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientGetSaldoCashbackCCPeloDono.php

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 7; 
$id_dono = 4; //9; 
$id_saldo = 0;

$retorno = $csi->getSaldoCashbackCCPeloDono($id_usuario, $id_dono);
var_dump($retorno);



?>
