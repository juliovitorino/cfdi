<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/fundoparticipacaoglobal/clientFundoParticipacaoGlobalInserirCreditoParticipante.php

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once 'FundoParticipacaoGlobalDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FundoParticipacaoGlobalDTO();

$dto->idUsuarioParticipante = 1000; // usua_id plano pago
//$dto->idUsuarioParticipante = 1003; // usua_id plano graatuito
$dto->idPlanoFatura = 1156;
$dto->valorTransacao = floatval(Util::getCodigoNumerico(3) . "." . Util::getCodigoNumerico(2)); // Valor válido acima de zero
//$dto->valorTransacao = floatval(Util::getCodigoNumerico(2) . "." . Util::getCodigoNumerico(2)) * -1; // Valor imcompativel
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new FundoParticipacaoGlobalServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrarCreditoPartipante($dto);
echo json_encode($retorno);
?>

























































































































































