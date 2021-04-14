<?php  

require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';

$dto = new campanhaDTO();

$dto->id_usuario = 100;
$dto->nome = '10 selos 1 Jantar';
$dto->textoExplicativo = Util::getCodigo(8) . ' - Junte 10 selos e ganhe um Jantar no cardapio de frutos do mar';
$dto->dataInicio = '2019-05-28';
$dto->dataTermino = '2019-12-31';
$dto->maximoCartoes = 10;
$dto->minimoDelay = 1;

$csi = new CampanhaServiceImpl();
$retorno = $csi->cadastrar($dto);
var_dump($retorno);



?>