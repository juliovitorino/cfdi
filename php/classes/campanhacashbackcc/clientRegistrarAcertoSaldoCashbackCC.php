<?php 

// URL http://localhost/cfdi/php/classes/campanhacashbackcc/clientRegistrarAcertoSaldoCashbackCC.php
// URL http://elitefinanceira.com/producao/cfdi/php/classes/campanhacashbackcc/clientRegistrarAcertoSaldoCashbackCC.php?usua_id=1000

require_once 'CampanhaCashbackCCServiceImpl.php';


$csi = new CampanhaCashbackCCServiceImpl();
$id_usuario = (int) $_GET['usua_id'];

$retorno = $csi->registrarSaldoCashbackCC($id_usuario);
var_dump($retorno);



?>
