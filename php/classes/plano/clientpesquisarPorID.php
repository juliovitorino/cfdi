<?php  

// URL = http://localhost/gc/php/classes/plano/clientPesquisarPorID.php

require_once 'PlanoServiceImpl.php';

$planoid = 2;

$psi = new PlanoServiceImpl();
$dto = $psi->pesquisarPorID($planoid);
var_dump($dto);
?>