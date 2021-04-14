<?php  
// URL http://localhost/cfdi/php/classes/cartao/clientListarCartaoComentarios.php

require_once 'cartaoServiceImpl.php';

$idcampanha=3;
$isPositivo=true;
$qtdeComentarios=(int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_COMENTARIOS_LISTAR);

$csi = new CartaoServiceImpl();
$retorno = $csi->listarAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios);
var_dump($retorno);

?>