<?php  

// url de teste GET
// http://localhost/cfdi/php/classes/campanhaqrcode/clientValidarTicket.php?ticket=BYfwr11f&token=59a58da0b854caee1d03d41c1d82f55655877b19

require_once '../campanhaqrcode/campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$ticket = $_GET['ticket']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarTicket($idfiel, $ticket);

echo json_encode($retorno);

?>
