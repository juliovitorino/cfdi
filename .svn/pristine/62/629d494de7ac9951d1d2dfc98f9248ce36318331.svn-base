<?php
// URL de teste
// http://localhost/cfdi/php/classes/cron/campanhaCriarCarimbosCron.php

ob_start();

require_once '../campanha/campanhaServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

// Carrega todos os projetos deste usuário e anexa ao 
// objeto principal
$csi = new CampanhaServiceImpl();
$retorno = $csi->criarCampanhasEmFila();        

// retorna resultado
echo json_encode($retorno);

ob_flush();

?>