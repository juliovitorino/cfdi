
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioCampanhaSorteioTicketPorUcstId.php?tokenid=xxx&ucstid=1005&pag=1
// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarUsuarioCampanhaSorteioTicketPorUcstId.php?tokenid=7af6924d287c70214adb9d9d7a1cc59376bc0cea&ucstid=1005&pag=1

// Importar dependencias
require_once '../usuariocampanhasorteioticket/UsuarioCampanhaSorteioTicketServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];
$ucstid = (int) $_GET['ucstid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new UsuarioCampanhaSorteioTicketServiceImpl();
$retorno = $csi->listarUsuarioCampanhaSorteioTicketPorUscsIdStatus($ucstid, ConstantesVariavel::STATUS_ATIVO, $pag);

echo json_encode($retorno);


?>

