<?php  
// URL exemplo 
// http://localhost/cfdi/php/classes/campanhaqrcode/clientValidarQrcode.php?qrc=3bcaeada1ef0e7384cc595b4d1f5ea568302f0ea&token=5dc12a47928bab564e1984e20869e3d24532917a

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$qrc = $_GET['qrc']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarQRCode($idfiel, $qrc);
var_dump($retorno);

?>