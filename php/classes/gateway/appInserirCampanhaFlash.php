<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirCampanhaFlash.php?tokenid=5b54191eb1695df5bf5d49196d39e957ad301c55&nome=ispsum&recompensa=lorem
// URL http://localhost/cfdi/php/classes/gateway/appInserirCampanhaFlash.php?tokenid=5b54191eb1695df5bf5d49196d39e957ad301c55&CAMP_TX_NOME=ispsum&CAMP_TX_RECOMPENSA=lorem

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
// Monta o DTO a partir dos dados obtidos do cliente invocador
$campdto = new CampanhaDTO();
$campdto->id_usuario = $sessaodto->usuariodto->id;
$campdto->nome = $_POST['nome'];
$campdto->recompensa = $_POST['recompensa'];

$csi = new CampanhaServiceImpl();
$retorno = $csi->cadastrarFlash($campdto);
echo json_encode($retorno);


?>