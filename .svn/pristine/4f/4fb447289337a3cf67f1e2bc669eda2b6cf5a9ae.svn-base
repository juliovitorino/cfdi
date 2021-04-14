<?php  

require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoServiceImpl.php';
require_once 'ConstantesEstatisticaFuncao.php';

$dto = new EstatisticaFuncaoDTO();

$dto->usuarioid = 185;
$dto->projetoid = 100;
$dto->ano = date('Y');
$dto->mes = date('m');
$dto->dia = date('d');
$dto->tipo = ConstantesEstatisticaFuncao::FUNCAO_PROJETO;

$efsi = new EstatisticaFuncaoServiceImpl();
$efsi->cadastrar($dto);


?>