<?php  
// URL http://localhost/cfdi/php/classes/client/clientListarCampanhasUsuario.php

require_once '../campanha/campanhaServiceImpl.php';

$idusuario = 4; // usuário existente dentro do banco de dados para teste unitário

$csi = new CampanhaServiceImpl();
$retorno = $csi->listarCampanhasUsuario($idusuario);
var_dump($retorno);

?>