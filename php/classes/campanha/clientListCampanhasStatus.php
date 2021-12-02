<?php  
// URL http://junta10.dsv:8080/cfdi/php/classes/campanha/clientListCampanhasStatus.php

require_once 'campanhaServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasPorStatus(ConstantesVariavel::STATUS_ATIVO);
//var_dump($retorno);
echo json_encode($retorno);



?>