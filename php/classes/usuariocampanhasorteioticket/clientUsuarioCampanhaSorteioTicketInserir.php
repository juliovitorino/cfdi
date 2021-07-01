<?php 
// URL http://elitefinanceira.com/cfdi/php/classes/usuariocampanhasorteioticket/clientUsuarioCampanhaSorteioTicketInserir.php?iduscs=1001

require_once 'UsuarioCampanhaSorteioTicketServiceImpl.php';
require_once 'UsuarioCampanhaSorteioTicketDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioCampanhaSorteioTicketDTO();

$dto->iduscs = (int) $_GET['iduscs'];
$dto->ticket = (int) Util::getCodigoNumerico(5);

var_dump($dto);
$csi = new UsuarioCampanhaSorteioTicketServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
