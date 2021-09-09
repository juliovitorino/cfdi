
<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarPlanoRecursoPorIdPlanoStatus.php?tokenid=cb1&idplano=1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarPlanoRecursoPorIdPlanoStatus.php?tokenid=cb1&idplano=1&pag=1

// Importar dependencias
require_once '../planorecurso/PlanoRecursoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];
$idplano = $_GET['idplano'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$status = ConstantesVariavel::STATUS_ATIVO;
$csi = new PlanoRecursoServiceImpl();
$retorno = $csi->listarPlanoRecursoPorIdplanoStatus($idplano, $status, $pag);

echo json_encode($retorno);


?>
