<?php 
// URL http://localhost/cfdi/php/classes/usuariotipoempreendimento/clientUsuarioTipoEmpreendimentoInserir.php

require_once 'UsuarioTipoEmpreendimentoServiceImpl.php';
require_once 'UsuarioTipoEmpreendimentoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new UsuarioTipoEmpreendimentoDTO();

$dto->id = 1;
$dto->idUsuario = 1;
$dto->idTipoEmpreendimento = 1;
$dto->status = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();

var_dump($dto);
$csi = new UsuarioTipoEmpreendimentoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
