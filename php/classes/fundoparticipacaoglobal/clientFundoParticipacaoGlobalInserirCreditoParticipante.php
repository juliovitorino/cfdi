<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/fundoparticipacaoglobal/clientFundoParticipacaoGlobalInserirCreditoParticipante.php
// URL http://elitefinanceira.com/cfdi/php/classes/fundoparticipacaoglobal/clientFundoParticipacaoGlobalInserirCreditoParticipante.php?tokenid=sd&idpart=1&idpluf=23434&vlr=47

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once 'FundoParticipacaoGlobalDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FundoParticipacaoGlobalDTO();

$dto->idUsuarioParticipante = (int) $_GET['idpart']; // usua_id plano pago
$dto->idPlanoFatura = (int) $_GET['idpluf'];
$dto->valorTransacao = floatval($_GET['vlr']); //floatval(Util::getCodigoNumerico(3) . "." . Util::getCodigoNumerico(2)); // Valor válido acima de zero
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new FundoParticipacaoGlobalServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrarCreditoPartipante($dto);
echo json_encode($retorno);
?>

























































































































































