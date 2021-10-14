<?php  
// URL exemplo 
// http://elitefinanceira.com/cfdi/php/classes/campanhaqrcode/clientValidarQrcode.php?qrc=xxx&token=4a1d5be0aa1c02c68ba7d3349dbbda8dddd28773
// http://junta10.dsv:8080/cfdi/php/classes/campanhaqrcode/clientValidarQrcode.php?qrc=xxx&token=4a1d5be0aa1c02c68ba7d3349dbbda8dddd28773

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$qrc = $_GET['qrc']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarQRCode($idfiel, $qrc);
echo json_encode($retorno);

?>