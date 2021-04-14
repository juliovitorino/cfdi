<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarCampanhasUsuario.php?tokenid=2c7614ecbc89e262bc455b03144033ca17eccb3a
// URL http://localhost/cfdi/php/classes/gateway/appListarCampanhasUsuario.php?tokenid=2c7614ecbc89e262bc455b03144033ca17eccb3a

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasUsuario($sessaodto->usuariodto->id);
echo json_encode($retorno);

?>