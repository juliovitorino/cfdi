<?php  
// URL exemplo 
// http://elitefinanceira.com/cfdi/php/classes/campanhaqrcode/clientValidarQrcode.php?qrc=xxx&token=b599c6c578a87b5f7740db3e4510253603fbefde

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$qrc = $_GET['qrc']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarQRCode($idfiel, $qrc);
echo json_encode($retorno);

?>