<?php  
// URL http://localhost/cfdi/php/classes/campanha/clientAtualizarQtdeSelos.php

require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';



//setup

//>>> Backend
$date = new DateTime();
$ts = $date->getTimestamp();
$idcampanha = 1;
$id_usuario = 4;

$csi = new CampanhaServiceImpl();
$dto = $csi->pesquisarPorID($idcampanha);
$dto->id_usuario = $id_usuario;
$dto->nome = "Campanha *** " . $ts;
$dto->maximoSelos = 20;
$dto->recompensa = 'Ganhe ' . rand(10,50) . '% de desconto na compra com após completar a cartela';
$dto->msgAgradecimento = "Obrigado pela Preferência *** " . $ts;
$dto->valorTicketMedioCarimbo = rand(1000,5000)/100;
$dto->fraseEfeito = "Frase de efeito *** " . $ts;
$dto->maximoSelos = rand(10,30);

$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo "Modificando a campanha $idcampanha <br><br>";
var_dump($retorno);



?>