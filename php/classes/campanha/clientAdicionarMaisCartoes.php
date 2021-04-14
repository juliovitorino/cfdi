<?php  

//http://localhost/cfdi/php/classes/campanha/clientAdicionarMaisCartoes.php

require_once './campanhaServiceImpl.php';

// usuario e campanha invalidos
//$id_campanha = 5426454;
//$id_usuario = 432646;

// usuário com plano gratuito, não permite a inclusão automatica
// ele precisa realizar a compra na loja online
//$id_campanha = 1;
//$id_usuario = 4;

// Usuario com plano que permite a inclusao automatica de cartoes na campanha
$id_campanha = 18;
$id_usuario = 22;

$csi = new CampanhaServiceImpl();
$retorno = $csi->adicionarMaisCartoes($id_campanha, $id_usuario);
var_dump($retorno);



?>