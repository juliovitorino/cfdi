<?php 
// URL http://junt10.dsv:8080/cfdi/php/classes/filaemail/clientFilaEmailInserir.php

require_once 'FilaEmailServiceImpl.php';
require_once 'FilaEmailDTO.php';
require_once 'FilaEmailConstantes.php';
require_once '../util/util.php';
require_once '../email/EmailDTO.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new FilaEmailDTO();
$dto->email = new EmailDTO();

$dto->id = 1;
//$dto->nomeFila = FilaEmailConstantes::FIEM_EMAIL_BOAS_VINDAS;
$dto->nomeFila = FilaEmailConstantes::FIEM_CONTATO_PELO_FALE_CONOSCO_SITE;
$dto->emailDe = "admin@junta10.com";
$dto->email->emaildestinatario = Util::getCodigo(10) . "@" . Util::getCodigo(5) . "com.br" ;
$dto->email->assunto = Util::getLoremIpsum()  . Util::getCodigo(10);
$dto->prioridade = FilaEmailConstantes::PRIOR_NORMAL;
$dto->email->template = "tmplt-"  . Util::getCodigo(10) . ".html";
$dto->nrMaxTentativas = Util::getCodigoNumerico(2);
$dto->dataPrevisaoEnvio = '2019-08-24 17:30:31';


var_dump($dto);
$csi = new FilaEmailServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>

