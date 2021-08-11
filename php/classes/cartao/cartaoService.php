<?php

/**
 * 
 * CartaoService
 */

// importar dependências

require_once '../interfaces/AppService.php';

interface CartaoService extends AppService{
    public function pesquisarPorCampanhaUsuarioStatus($idusuario, $idcampanha, $status);
    public function incrementarContador($id,$qrcodecarimbo);
    public function listarCartoesFullInfoAtivos($idusuario);
    public function listarCartoesFullInfoAtivos10M($idusuario);
    public function listarCartoesFullInfoFavoritosAtivos($idusuario);
    public function listarCartoesFullInfoCompletosAtivos($idusuario);
    public function listarCartoesFullInfoProcessoResgate($idusuario);
    public function atualizarStatus($id, $status);
    public function realizarResgateCartao($hash, $id_usuario);
    public function realizarEntregaRecompensa($hash, $id_usuario);
    public function pesquisarCartaoFull($id, $id_usuario);
	public function pesquisarCartaoFullCarimbo($carimbo, $id_usuario, $status=ConstantesVariavel::STATUS_ATIVO);
    public function realizarConfirmacaoRecebimentoRecompensa($hash, $id_usuario);
    public function atualizarCartaoLike($id, $idusuario);
    public function realizarAvaliacaoCartao($hash, $id_usuario, $rating, $comentario);    
    public function atualizarCartaoFavoritos($idcartao, $idusuario);
    public function listarAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios=0 );
    public function moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
    public function moverSeloCartaoParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao);
}


?>