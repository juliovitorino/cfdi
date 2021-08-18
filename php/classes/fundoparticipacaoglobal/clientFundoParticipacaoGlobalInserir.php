<?php 
// URL http://localhost/cfdi/php/classes/fundoparticipacaoglobal/clientFundoParticipacaoGlobalInserir.php

require_once 'FundoParticipacaoGlobalServiceImpl.php';
require_once 'FundoParticipacaoGlobalDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FundoParticipacaoGlobalDTO();

$dto->id = 1;
$dto->idUsuarioParticipante = 1;
$dto->idUsuarioBonificado = 1;
$dto->idPlanoFatura = 1;
$dto->tipoMovimento = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->valorTransacao = floatval(Util::getCodigo(2) . "." . Util::getCodigo(2));
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();

var_dump($dto);
$csi = new FundoParticipacaoGlobalServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

























































































































































