<?php  

require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoServiceImpl.php';

$dto = new EstatisticaFuncaoDTO();
$date = new DateTime();

$dto->usuarioid = 1;
$dto->projetoid = 1;
$dto->ano = 2008;
$dto->mes = 8;
$dto->dia = 8;
$dto->tipo = 'INSERCAO_NA_MAO ' . $date->getTimestamp();

$efsi = new EstatisticaFuncaoServiceImpl();
$efsi->cadastrar($dto);
$efsi->incrementarQtde($dto->tipo, $dto->dia, $dto->mes, $dto->ano, $dto->usuarioid, $dto->projetoid);


?>