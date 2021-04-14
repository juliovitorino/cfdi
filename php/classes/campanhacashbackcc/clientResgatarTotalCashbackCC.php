<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientResgatarTotalCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';
require_once '../util/util.php';
require_once '../variavel/ConstantesVariavel.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 7;
$id_dono = 4;
$vllancar = 0.12; //rand(1,1000)/100;
$descricao = 'Resgate ' . Util::getCodigo(15) ;
$tipolancar = ConstantesVariavel::DEBITO;

$retorno = $csi->ResgatarTotalCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);

var_dump($retorno);



?>
