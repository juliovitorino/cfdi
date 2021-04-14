<?php

// URL http://localhost/cfdi/php/classes/gateway/appBuscarCartoesFavoritosCampanhaAtivo.php?tokenid=234234
// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appBuscarCartoesFavoritosCampanhaAtivo.php?tokenid=cdaecd0f0834260804e3778758ec825c9c8211af

// Importar dependencias
require_once '../cartao/cartaoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new CartaoServiceImpl();
$retorno = $csi->listarCartoesFullInfoFavoritosAtivos($sessaodto->usuariodto->id);
echo json_encode($retorno);


?>