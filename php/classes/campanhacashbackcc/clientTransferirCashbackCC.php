<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientTransferirCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';
require_once '../util/util.php';

$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 7;
$id_dono = 4;
$vllancar = rand(1,800)/100;
$descricao = Util::getLoremIpsum() . '.';

$retorno = $csi->TransferirCashbackCC($id_usuario, $id_dono, $vllancar, $descricao);
var_dump($retorno);



?>
