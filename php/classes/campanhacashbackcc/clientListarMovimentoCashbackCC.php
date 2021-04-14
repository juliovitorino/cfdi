<?php 

// URL http://elitefinanceira.com/cfdi/php/classes/campanhacashbackcc/clientListarMovimentoCashbackCC.php
// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientListarMovimentoCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 7; //2893; //7;
$id_dono = 4; //9; //762; //9;
$numdias = 30;

$retorno = $csi->listarMovimentoCashbackCC($id_usuario, $id_dono, $numdias);
var_dump($retorno);



?>
