<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/grupoadminfuncoesadminusuario/clientGrupoAdminFuncoesAdminUsuarioInserir.php

require_once 'GrupoAdminFuncoesAdminUsuarioServiceImpl.php';
require_once 'GrupoAdminFuncoesAdminUsuarioDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new GrupoAdminFuncoesAdminUsuarioDTO();

$dto->idGrupoAdmFuncoesAdm = 1000;
$dto->id_usuario = 1000;

var_dump($dto);
$csi = new GrupoAdminFuncoesAdminUsuarioServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
