
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhaSorteio.php?tokenid=cb1&pag=1&id_camp=1004
// URL http://localhost/cfdi/php/classes/gateway/appListarCampanhaSorteio.php?tokenid=cb1&pag=1&id_camp=1004

// Importar dependencias
require_once '../campanhasorteio/CampanhaSorteioServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];
$camp_id = (int) $_GET['id_camp'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaSorteioServiceImpl();
$retorno = $csi->listarCampanhaSorteioPorCampId($camp_id, $pag);

echo json_encode($retorno);


?>

