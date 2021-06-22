<?php 
// URL http://elitefinanceira.com/cfdi/php/classes/usuariocampanhasorteio/clientUsuarioCampanhaSorteioInserir.php

require_once 'UsuarioCampanhaSorteioServiceImpl.php';
require_once 'UsuarioCampanhaSorteioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$uscsdto = new UsuarioCampanhaSorteioDTO();

$uscsdto->idUsuario = 1005;
$uscsdto->idCampanhaSorteio = 1139;
$uscsdto->ticket = (int) Util::getCodigoNumerico(5);

var_dump($uscsdto);
$csi = new UsuarioCampanhaSorteioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($uscsdto);
echo json_encode($retorno);
?>
