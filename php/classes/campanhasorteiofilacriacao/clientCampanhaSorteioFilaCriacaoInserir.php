<?php 
// URL http://localhost/cfdi/php/classes/campanhasorteiofilacriacao/clientCampanhaSorteioFilaCriacaoInserir.php
// URL http://junta10.dsv/cfdi/php/classes/campanhasorteiofilacriacao/clientCampanhaSorteioFilaCriacaoInserir.php



require_once 'CampanhaSorteioFilaCriacaoServiceImpl.php';
require_once 'CampanhaSorteioFilaCriacaoDTO.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaSorteioFilaCriacaoDTO();

$dto->id = 1;
$dto->id_caso = 1000;
$dto->qtLoteTicketCriar = Util::getCodigoNumerico(5);
$dto->status = 'P';
$dto->dataCadastro = Util::getNow();
$dto->dataAtualizacao = Util::getNow();


var_dump($dto);
$csi = new CampanhaSorteioFilaCriacaoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
