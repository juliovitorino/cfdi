<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appUsuarioPublicidadeHabilitar.php?tokenid=cb1&uspuid=1
// URL http://localhost/cfdi/php/classes/gateway/appUsuarioPublicidadeHabilitar.php?tokenid=5dc1a&uspuid=1

// Importar dependencias
require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$uspuid = $_GET['uspuid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new UsuarioPublicidadeServiceImpl();
$retorno = $csi->autalizarStatusUsuarioPublicidade($uspuid, ConstantesVariavel::STATUS_ATIVO);

echo json_encode($retorno);


?>


