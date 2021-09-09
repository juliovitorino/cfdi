<?php 
// URL http://localhost/cfdi/php/classes/planorecurso/clientPlanoRecursoInserir.php

require_once 'PlanoRecursoServiceImpl.php';
require_once 'PlanoRecursoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new PlanoRecursoDTO();

$dto->id = 1;
$dto->idplano = 1;
$dto->idrecurso = 1;
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();

var_dump($dto);
$csi = new PlanoRecursoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

























































































































































