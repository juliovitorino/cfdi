<?php  

require_once 'campanhaQrCodeServiceImpl.php';

// pegue os códigos dentro do banco de dados para realizar os testes unitários
$idcampanha = 9999; // campanha para teste de campanha inexistente
$idcampanha = 1; // campanha válida com status 'A' para teste de campanha inexistente
$idcampanha = 2; // campanha válida com status 'P' para teste de campanha inexistente

$csi = new CampanhaQrCodeServiceImpl();
$retorno = $csi->criarCarimbosCampanha($idcampanha);
var_dump($retorno);



?>