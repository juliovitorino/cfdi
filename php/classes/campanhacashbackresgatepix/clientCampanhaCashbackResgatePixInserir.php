<?php 
// URL http://junta10.dsv:8080/cfdi/php/classes/campanhacashbackresgatepix/clientCampanhaCashbackResgatePixInserir.php

require_once 'CampanhaCashbackResgatePixServiceImpl.php';
require_once 'CampanhaCashbackResgatePixDTO.php';
require_once 'CampanhaCashbackResgatePixConstantes.php';
require_once '../util/util.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new CampanhaCashbackResgatePixDTO();

$dto->idCampanhaCashback = 1000;
$dto->idUsuarioSolicitante = 1000;

/* possibilidades para teste 
const TIPO_CHAVEPIX_CPF = '0';
const TIPO_CHAVEPIX_CNPJ = '1';
const TIPO_CHAVEPIX_CELULAR = '2';
const TIPO_CHAVEPIX_EMAIL = '3';
const TIPO_CHAVEPIX_ALEATORIA = '4';
*/

$dto->tipoChavePix = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CPF;

switch ($dto->tipoChavePix) {
    case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CPF:
        $dto->chavePix = Util::getCodigoNumerico(11);
        break;
    
    case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CNPF:
        $dto->chavePix = Util::getCodigoNumerico(14);
        break;
    case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CELULAR:
        $dto->chavePix = Util::getCodigoNumerico(11);
        break;
    case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_EMAIL:
        $dto->chavePix = Util::getCodigo(9) . "@" . Util::getCodigo(5) . "." . Util::getCodigo(3) . ".br";
        break;
    case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_ALEATORIA:
        $dto->chavePix = Util::getCodigo(4) . "-" . Util::getCodigo(4) . "-" . Util::getCodigo(4);
        break;        
            
    default:
        $dto->chavePix = Util::getCodigo(4) . "-" . Util::getCodigo(4) . "-" . Util::getCodigo(4);
        break;
}


$dto->valorResgate = floatval(Util::getCodigoNumerico(2) . "." . Util::getCodigoNumerico(2)) ;

var_dump($dto);
$csi = new CampanhaCashbackResgatePixServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno);
?>
