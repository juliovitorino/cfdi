
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarGrupoAdministracao.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarGrupoAdministracao.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../grupoadministracao/GrupoAdministracaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new GrupoAdministracaoServiceImpl();
$retorno = $csi->listarGrupoAdministracao($pag);

echo json_encode($retorno);


?>
