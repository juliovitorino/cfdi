<?php  

// URL http://localhost/cfdi/php/classes/usuariosplanos/clientPesquisarPlanoAtivo.php

require_once 'PlanoUsuarioServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';

$usuarioid = 1;

$pusi = new PlanoUsuarioServiceImpl();
$plus_id_ativo = $pusi->pesquisarPlanoUsuarioPorStatus($usuarioid, ConstantesVariavel::STATUS_ATIVO);
$plusdto = $pusi->pesquisarPorID($plus_id_ativo);

// esse metodo faz os dois acima em apenas 1 passo
$retorno = $pusi->pesquisarPlanoUsuarioAtivo($usuarioid);
var_dump($retorno);


?>