<?php 
// URL http://localhost/cfdi/php/classes/campanhasorteionumerospermitidos/clientCampanhaSorteioNumerosPermitidosInserir.php
// URL http://junta10.dsv/cfdi/php/classes/campanhasorteionumerospermitidos/clientCampanhaSorteioNumerosPermitidosInserir.php
// URL http://elitefinanceira.com/cfdi/php/classes/campanhasorteionumerospermitidos/clientCampanhaSorteioNumerosPermitidosInserir.php?idcaso=1139

require_once 'CampanhaSorteioNumerosPermitidosServiceImpl.php';
require_once 'CampanhaSorteioNumerosPermitidosDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaSorteioNumerosPermitidosDTO();

$dto->id = 1;
$dto->id_caso = (int) $_GET['idcaso'];
$dto->nrTicketSorteio =(int) Util::getCodigoNumerico(5);


var_dump($dto);
$csi = new CampanhaSorteioNumerosPermitidosServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
