<?php  

// url de teste GET
// http://localhost/cfdi/php/classes/campanhaqrcode/clientValidarTicket.php?ticket=7K4PR8xI&token=d3850e72de58c9e72aa016ff90156d4d3c81d418

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$ticket = $_GET['ticket']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarTicket($idfiel, $ticket);
var_dump($retorno);

?>
