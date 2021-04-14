<?php  
// URL http://localhost/cfdi/php/classes/campanha/clientAtualizarStatus.php

require_once 'campanhaServiceImpl.php';
// Siga a ordem da maquina de estado para testar. P => F => W => A => I
$id_campanha = 19;
$status = "I";

$csi = new CampanhaServiceImpl();
$retorno = $csi->autalizarStatusCampanha($id_campanha, $status);
var_dump($retorno);



?>