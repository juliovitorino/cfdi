<?php 
// URL http://elitefinanceira.com/cfdi/php/classes/registroindicacao/clientRegistroIndicacaoInserir.php?idup=1006&idui=1007

require_once 'RegistroIndicacaoServiceImpl.php';
require_once 'RegistroIndicacaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new RegistroIndicacaoDTO();
$dto->idUsuarioPromotor = (int) $_GET['idup'];
$dto->idUsuarioIndicado = (int) $_GET['idui'];

var_dump($dto);
$csi = new RegistroIndicacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
