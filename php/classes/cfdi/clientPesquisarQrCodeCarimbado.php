<?php  
// URL http://localhost/cfdi/php/classes/cfdi/clientPesquisarQrCodeCarimbado.php

require_once 'cfdiServiceImpl.php';
require_once 'cfdiDTO.php';
require_once '../util/util.php';

$qrc = 'ffbc638ec813dda105d1ece897dcb2f36c8e677c';
$csi = new CfdiServiceImpl();
$retorno = $csi->pesquisarPorCarimbo($qrc);
var_dump($retorno);



?>