<?php  

require_once 'PlanoUsuarioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

/* opções de funcionalidade 
	const PERM_PROJETO = 0;
	const PERM_HEADLINES = 1;
	const PERM_MINISITES = 2;
	const PERM_POST_REDE_SOCIAL = 3;
	const PERM_ENGAJAMENTO_SOCIAL = 4;
	const PERM_ADS = 5;
	const PERM_BACKLINK = 6;
*/
$funcionalidade = ConstantesPlano::PERM_PROJETO;
$usuarioid = 185;

$pusi = new PlanoUsuarioServiceImpl();
$res = $pusi->verificarPermissaoPlano($usuarioid, $funcionalidade);
var_dump($res);

?>