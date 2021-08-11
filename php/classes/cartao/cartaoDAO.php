<?php

require_once '../interfaces/DAO.php';

/**
 * CartaoDAO - Extensão da interface padrão de DAO
 */
interface CartaoDAO extends DAO
{
	public function updateStatus($id, $status);
	public function updateDataCartaoCompletou($id);
	public function updateDataCartaoValidou($id);
	public function updateDataCartaoEntregou($id);
	public function updateDataCartaoRecebeuRecompensa($id);
	public function updateMoverCartaoInteiroParaOutroUsuario($idusuarioDestino, $idCartao);
	public function loadCampanhaUsuarioStatus($idusuario, $idcampanha, $status);
	public function loadHashResgate($hash);
	public function incrementarContador($id,$qrcodecarimbo);
	public function listAllCartaoPorUsuarioStatus($idusuario, $status);
	public function listAllCartaoPorUsuarioStatus10M($idusuario, $status);
	public function listAllCartaoPorUsuarioProcessoResgate($idusuario);
	public function listAllCartaoFavoritosPorUsuarioStatus($idusuario, $status);
	public function updateLike($id, $isLike);
	public function updateRatingComentario($id, $rating, $comentario);
	public function updateFavorito($idcartao, $isFavorito);
	public function listAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios);
	public function countParticipantesCampanha($id_campanha);
	public function countCartaoPorCampId($id_campanha);
	public function listParticipantesCampanha($id_campanha, $pag, $qtde);
}
?>