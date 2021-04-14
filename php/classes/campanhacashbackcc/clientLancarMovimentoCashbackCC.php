<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientLancarMovimentoCashbackCC.php

require_once 'CampanhaCashbackCCServiceImpl.php';
require_once '../util/util.php';
require_once '../variavel/ConstantesVariavel.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = 0; // 0 = hoje; 7= 7 dias e assim por diante

$id_usuario = 7;
$id_dono = 4;
$vllancar = rand(1,1000)/100;
$descricao = Util::getLoremIpsum();
$tipolancar = ConstantesVariavel::DEBITO;

$retorno = $csi->lancarMovimentoCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);
var_dump($retorno);



?>
