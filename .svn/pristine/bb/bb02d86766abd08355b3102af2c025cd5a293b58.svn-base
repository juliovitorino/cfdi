<?php  

require_once 'PlanoUsuarioFaturaDTO.php';
require_once 'PlanoUsuarioFaturaServiceImpl.php';

require_once '../plano/PlanoServiceImpl.php';
require_once '../usuariosplanos/PlanoUsuarioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$usuarioid = 1;
$planoid = 3;

$pi = new PlanoServiceImpl();
$pdto = $pi->pesquisarPorID($planoid);
//var_dump($pdto);

$pudto = new PlanoUsuarioDTO( $usuarioid, $pdto);
//var_dump($pudto);

$pusi = new PlanoUsuarioServiceImpl();
$ok = $pusi->cadastrar($pudto);
var_dump($ok);

$plus_id_pendente = $pusi->pesquisarPlanoUsuarioPorStatus($usuarioid, ConstantesVariavel::STATUS_PENDENTE);
var_dump($plus_id_pendente);

$pufdto = new PlanoUsuarioFaturaDTO();
$pufdto->planousuarioid = $plus_id_pendente;
$pufdto->valorfatura = $pudto->valor;
$pufdto->valordesconto = 0;
$pufdto->dataVencimento = '2018-08-31';

$pufsi = new PlanoUsuarioFaturaServiceImpl();
$ok = $pufsi->cadastrar($pufdto);
var_dump($ok);

?>