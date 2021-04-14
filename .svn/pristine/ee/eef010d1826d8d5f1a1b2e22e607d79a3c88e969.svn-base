<?php  

require_once 'PlanoUsuarioDTO.php';
require_once 'PlanoUsuarioServiceImpl.php';

require_once '../plano/PlanoServiceImpl.php';
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

$plus_id_ativo = $pusi->pesquisarPlanoUsuarioPorStatus($usuarioid, ConstantesVariavel::STATUS_ATIVO);
$plus_id_pendente = $pusi->pesquisarPlanoUsuarioPorStatus($usuarioid, ConstantesVariavel::STATUS_PENDENTE);
var_dump($plus_id_ativo);
var_dump($plus_id_pendente);

$res = $pusi->atualizarPlanoUsuarioPorId($plus_id_pendente, ConstantesVariavel::STATUS_ATIVO);
var_dump($res);


?>