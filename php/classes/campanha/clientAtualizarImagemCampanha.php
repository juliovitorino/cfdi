<?php  
// URL http://localhost/cfdi/php/classes/campanha/clientAtualizarImagemCampanha.php

require_once 'campanhaServiceImpl.php';
$id_campanha = 3;
$arquivo = 'plingo50.png';

$csi = new CampanhaServiceImpl();
$retorno = $csi->autalizarImagemCampanha($id_campanha, $arquivo);
var_dump($retorno);



?>