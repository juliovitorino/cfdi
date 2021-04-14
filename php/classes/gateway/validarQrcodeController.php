<?php  
// URL exemplo http://localhost/cfdi/php/classes/gateway/validarQrcodeController.php?qrc=313b232f435de4908304d37de8ca1e2b44fd1232&token=8955451b4016d06c0cdc04c39fe71ae8a5d7c0c1

require_once '../campanhaqrcode/campanhaQrCodeServiceImpl.php';
require_once '../trace/traceHelper.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$qrc = $_GET['qrc']; // campanha para teste de campanha inexistente
$idfiel = $_GET['token']; // Token da sessao do banco de dados

// Trace configuravel pela aplicação para debug
//TraceHelper::traceLog(ConstantesVariavel::TRACE_DEBUG, 'validarQrcodeController.php', ': qrc => ' . $qrc . ' ::: token => ' . $idfiel);

// Invoca serviço

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->validarQRCode($idfiel, $qrc);

echo json_encode($retorno);

?>