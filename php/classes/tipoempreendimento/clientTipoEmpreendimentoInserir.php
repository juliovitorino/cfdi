<?php 
// URL http://localhost/cfdi/php/classes/tipoempreendimento/clientTipoEmpreendimentoInserir.php

require_once 'TipoEmpreendimentoServiceImpl.php';
require_once 'TipoEmpreendimentoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new TipoEmpreendimentoDTO();

//$dto->id = 1;
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->urlimg = Util::getLoremIpsum()  . Util::getCodigo(10);
/*
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();
*/

var_dump($dto);
$csi = new TipoEmpreendimentoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
