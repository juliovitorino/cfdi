<?php

// URL https://www.junta10.com/php/classes/gateway/appAtualizarDadosCampanha.php?tokenid=cb3&idcamp=12&nome=julio&regras=regra1&dataInicio=2019-08-03%2012:26:00&dataTermino=2020-08-03%2012:26:00&limMaxSelos=12&recompensa=garrafa&fraseAgradecimento=obrigado&fraseEfeito=foda&vlticket=12.59
// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appAtualizarDadosCampanha.php?tokenid=cb3&idcamp=12&nome=julio&regras=regra1&dataInicio=2019-08-03%2012:26:00&dataTermino=2020-08-03%2012:26:00&limMaxSelos=12&recompensa=garrafa&fraseAgradecimento=obrigado&fraseEfeito=foda&vlticket=12.59

// URL http://localhost/cfdi/php/classes/gateway/appAtualizarDadosCampanha.php?tokenid=a9ed2b1fe2973856ad97eb8c986636864148e290&idcamp=1006&nome=julio&regras=regra1&dataInicio=2019-08-03%2012:26:00&dataTermino=2020-08-03%2012:26:00&limMaxSelos=12&recompensa=garrafa&fraseAgradecimento=obrigado&fraseEfeito=foda&vlticket=12.59

// Importar dependencias
require_once '../campanha/campanhaServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];
$idcamp = $_POST['idcamp'];
$nome = $_POST['nome'];
$regras = $_POST['regras'];
$dataInicio = $_POST['dataInicio'];
$dataTermino = $_POST['dataTermino'];
$limMaxSelos = (int) $_POST['limMaxSelos'];
$recompensa = $_POST['recompensa'];
$fraseAgradecimento = $_POST['fraseAgradecimento'];
$fraseEfeito = $_POST['fraseEfeito'];
$vlticket = (double) $_POST['vlticket'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$dto = new CampanhaDTO();
$dto->id = (int) $idcamp;
$dto->id_usuario = $sessaodto->usuariodto->id;
$dto->nome = $nome;
$dto->textoExplicativo = $regras;
$dto->dataInicio = $dataInicio;
$dto->dataTermino = $dataTermino;
$dto->recompensa = $recompensa;
$dto->msgAgradecimento = $fraseAgradecimento;
$dto->valorTicketMedioCarimbo = $vlticket;
$dto->fraseEfeito = $fraseEfeito;
$dto->maximoSelos = (int) $limMaxSelos;
$dto->fraseAgradecimento = $fraseAgradecimento;
$dto->valorTicketMedioCarimbo = (double) $vlticket;

$csi = new CampanhaServiceImpl();
$retorno = $csi->atualizar($dto);
echo json_encode($retorno);

?>