<?php  
// URL http://localhost/cfdi/php/classes/campanha/clientAtualizarCampanha.php

require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';


// Insira uma campanha e pegue o código dela para usar
// http://localhost/cfdi/php/classes/campanha/clientInserirFlash.php

//setup
$id_usua_inexistente = 9090;
$idcampanha = 24;

//>>> Backend
$date = new DateTime();
$ts = $date->getTimestamp();
// Tentar mudar o dono da campanha para um usuário inexistente
$csi = new CampanhaServiceImpl();
$dto = $csi->pesquisarPorID($idcampanha);
$dto->id_usuario = $id_usua_inexistente;
$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo "Tentar mudar o dono da campanha para um usuário inexistente<br><br>";
var_dump($retorno);

//>>> Backend
$date = new DateTime();
$ts = $date->getTimestamp();
$idcampanha = 25;
$csi = new CampanhaServiceImpl();
$dto = $csi->pesquisarPorID($idcampanha);
$dto->nome = "Campanha *** " . $ts;
$dto->recompensa = 'Ganhe ' . rand(10,50) . '% de desconto na compra com após completar a cartela';
$dto->msgAgradecimento = "Obrigado pela Preferência *** " . $ts;
$dto->valorTicketMedioCarimbo = rand(1000,5000)/100;
$dto->fraseEfeito = "Frase de efeito *** " . $ts;
$dto->maximoSelos = rand(10,30);

$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo "Modificando a campanha $idcampanha <br><br>";
var_dump($retorno);

//>>> Backend
$date = new DateTime();
$ts = $date->getTimestamp();
$idcampanha = 26;
$csi = new CampanhaServiceImpl();
$dto = $csi->pesquisarPorID($idcampanha);
$dto->nome = "Campanha *** " . $ts;
$dto->fraseEfeito = "Frase de efeito *** " . $ts;
$dto->recompensa = 'Ganhe ' . rand(10,50) . '% de desconto na compra com após completar a cartela';
$dto->msgAgradecimento = "Obrigado pela Preferência *** " . $ts;
$dto->valorTicketMedioCarimbo = rand(1000,5000)/100;
$dto->maximoSelos = 5000;
$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo "Modificando maximoSelos para $dto->maximoSelos a campanha $idcampanha <br><br>";
var_dump($retorno);

$date = new DateTime();
$ts = $date->getTimestamp();
$idcampanha = 3;
$csi = new CampanhaServiceImpl();
$dto = $csi->pesquisarPorID($idcampanha);
$dto->nome = "Campanha *** " . $ts;
$dto->fraseEfeito = "Frase de efeito *** " . $ts;
$dto->recompensa = 'Ganhe ' . rand(10,50) . '% de desconto na compra com após completar a cartela';
$dto->msgAgradecimento = "Obrigado pela Preferência *** " . $ts;
$dto->valorTicketMedioCarimbo = rand(1000,5000)/100;
$dto->maximoSelos = 5000;
$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo "Modificando maximoSelos para $dto->maximoSelos a campanha $idcampanha <br><br>";
var_dump($retorno);





?>