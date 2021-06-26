<?php  

//http://localhost/cfdi/php/classes/campanha/clientAdicionarMaisCarimbosCampanha.php?id_user=1006&id_camp=1004
//http://elitefinanceira.com/producao/cfdi/php/classes/campanha/clientAdicionarMaisCarimbosCampanha.php?id_user=1000&id_camp=1000
//http://elitefinanceira.com/cfdi/php/classes/campanha/clientAdicionarMaisCarimbosCampanha.php?id_user=1000&id_camp=1041

require_once './campanhaServiceImpl.php';

$id_usuario = (int) $_GET['id_user'];
$id_campanha = (int) $_GET['id_camp'];


$csi = new CampanhaServiceImpl();
$retorno = $csi->criarCampanhaCarimbosPendentesProduzir($id_usuario, $id_campanha);
var_dump($retorno);



?>