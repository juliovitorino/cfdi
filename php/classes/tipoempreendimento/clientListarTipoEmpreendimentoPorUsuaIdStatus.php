

<?php 

// URL http://localhost/cfdi/php/classes/tipoempreendimento/clientListarTipoEmpreendimentoPorUsuaIdStatus.php

require_once 'TipoEmpreendimentoServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$csi = new TipoEmpreendimentoServiceImpl();
$status = ConstantesVariavel::STATUS_ATIVO;
$usuaid = 1;

// Imprime a 1a pagina
$retorno = $csi->listarTipoEmpreendimentoPorUsuaIdStatus($usuaid,$status,1,2);
var_dump($retorno);

// Imprime a 2a pagina
$retorno = $csi->listarTipoEmpreendimentoPorUsuaIdStatus($usuaid,$status,2,2);
var_dump($retorno);

// Imprime a 3a pagina
$retorno = $csi->listarTipoEmpreendimentoPorUsuaIdStatus($usuaid,$status,3,2);
var_dump($retorno);


?>
