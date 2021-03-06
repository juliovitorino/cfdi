<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/fundoparticipacaoglobal/clientFundoParticipacaoGlobalInserirCreditoBonificacao.php

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once 'FundoParticipacaoGlobalDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FundoParticipacaoGlobalDTO();

$dto->idUsuarioParticipante = 1000;
$dto->idUsuarioBonificado = 1003;
$dto->valorTransacao = floatval(Util::getCodigoNumerico(2) . "." . Util::getCodigoNumerico(2)) * -1;
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new FundoParticipacaoGlobalServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrarCreditoBonificacao($dto);
echo json_encode($retorno);
?>

























































































































































