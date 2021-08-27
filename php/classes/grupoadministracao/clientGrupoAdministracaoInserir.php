<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/grupoadministracao/clientGrupoAdministracaoInserir.php

require_once 'GrupoAdministracaoServiceImpl.php';
require_once 'GrupoAdministracaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new GrupoAdministracaoDTO();

$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new GrupoAdministracaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
