<?php

/**
 * 
 * CartaoBusiness
 */

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CartaoBusiness extends BusinessObject
{
	public function atualizarStatus($daofactory, $id, $status);
	public function atualizarLike($daofactory, $id, $idusuario);
	public function pesquisarPorCampanhaUsuarioStatus($daofactory, $idusuario, $idcampanha, $status);
	public function incrementarContador($daofactory, $id,$qrcodecarimbo);
	public function listarCartoesFullInfo($daofactory, $idusuario, $status);
	public function listarCartoesFullInfo10M($daofactory, $idusuario, $status);
	public function listarCartoesFullInfoFavoritos($daofactory, $idusuario, $status);
	public function listarCartoesFullInfoProcessoResgate($daofactory, $idusuario);
	public function carregarPorHashResgate($daofactory, $hash);
	public function carregarCartaoFull($daofactory, $id, $id_usuario);
	public function carregarCartaoFullCarimbo($daofactory, $carimbo, $id_usuario, $status);
	public function atualizarAvaliacao($daofactory, $id, $rating='5', $comentario='');
	public function atualizarFavoritos($daofactory, $idcartao, $idusuario); 
	public function listarAllCartaoComentarios($daofactory, $idcampanha, $isPositivo, $qtdeComentarios=0 );	
	public function contarParticipantesCampanha($daofactory, $id_campanha);
	public function listarParticipantesCampanha($daofactory, $id_campanha, $pag, $qtde);
	public function moverCartaoInteiroParaOutroUsuario($daofactory, $idusuarioDono, $idusuarioDestino, $idCartao);


}

?>
