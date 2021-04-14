<?php 

require_once '../mkdlista/MkdListaServiceImpl.php';
require_once '../mkdlista/MkdListaDTO.php';
require_once '../util/util.php';

$dto = new MkdListaDTO();

$dto->id_mkd_campanha = (int) $_POST['campanha']; // Campanha pré existente
$dto->nome = $_POST['name'];
$dto->email = $_POST['email'];

$csi = new MkdListaServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);

if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
    include "../../../light/instrucoes.html";
    die();
}


?>
