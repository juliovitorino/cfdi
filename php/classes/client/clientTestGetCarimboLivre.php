<?php  
// URL http://localhost/cfdi/php/classes/client/clientTestGetCarimboLivre.php

require_once '../campanha/campanhaServiceImpl.php';

$idcampanha = 26; // usuário existente dentro do banco de dados para teste unitário
$idusuario = 2897; // usuário existente dentro do banco de dados para teste unitário

$csi = new CampanhaServiceImpl();
$retorno = $csi->getCarimboLivre($idcampanha, $idusuario);
var_dump($retorno);



?>