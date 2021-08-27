<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/grupoadminfuncoesadmin/clientGrupoAdminFuncoesAdminInserir.php

require_once 'GrupoAdminFuncoesAdminServiceImpl.php';
require_once 'GrupoAdminFuncoesAdminDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new GrupoAdminFuncoesAdminDTO();

$dto->idGrupoAdministracao = 1000;
$dto->idFuncoesAdministrativas = 1000;
$dto->descricao = Util::getLoremIpsum()  . Util::getCodigo(10);

var_dump($dto);
$csi = new GrupoAdminFuncoesAdminServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

