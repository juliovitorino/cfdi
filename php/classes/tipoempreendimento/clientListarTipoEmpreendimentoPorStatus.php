<?php  

// URL http://localhost/cfdi/php/classes/tipoempreendimento/clientListarTipoEmpreendimentoPorStatus.php

require_once 'tipoEmpreendimentoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new TipoEmpreendimentoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;

$retorno = $csi->listarTipoEmpreendimentoPorStatus($status,1,2);
var_dump($retorno);

$retorno = $csi->listarTipoEmpreendimentoPorStatus($status,2,2);
var_dump($retorno);

$retorno = $csi->listarTipoEmpreendimentoPorStatus($status,3,2);
var_dump($retorno);


?>
