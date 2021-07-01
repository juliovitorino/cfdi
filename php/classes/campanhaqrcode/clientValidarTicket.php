<?php  

// url de teste GET
// http://elitefinanceira.com/cfdi/php/classes/campanhaqrcode/clientValidarTicket.php?ticket=66f78ecdf6de32dba17851e966f5ca1796e47372&token=71dbfdccab975515f3e364f5206e910bde217eb1

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$ticket = $_GET['ticket']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarTicket($idfiel, $ticket);
var_dump($retorno);

?>
