<?php

// http://elitefinanceira.com/cfdi/php/classes/gateway/appRealizarAvaliacaoCartao.php?tokenid=8aa3cf54885f5d74b9139bc3ac8eb90da5097c85&hash=75f3af30112bf8f052435c7b938a29765ac55f7e&rating=5&comentario=MUITOFODA
// http://localhost/cfdi/php/classes/gateway/appRealizarAvaliacaoCartao.php?tokenid=sdf&hash=JHG&rating=5&comentario=xpto

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];
$hash = $_POST['hash'];
$rating = $_POST['rating'];
$comentario = $_POST['comentario'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $csi->realizarAvaliacaoCartao($hash, $sessaodto->usuariodto->id, $rating, $comentario);
echo json_encode($retorno);

?>