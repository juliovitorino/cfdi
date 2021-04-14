<?php

/**
 * 
 * BacklinkService
 */

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaService extends AppService{

	public function listarCampanhasUsuario($id_usuario);
	public function autalizarStatusCampanha($id_campanha, $status);
	public function listarCampanhasPorStatus($status);
	public function criarCampanhasEmFila();
	public function getCarimboLivre($idcampanha, $idusuario);
	public function criarCampanhaPorParceiroCampanha($id_usuario, $id_campanha);
	public function cadastrarFlash($dto);
	public function cancelar($dto);
	public function incrementarContadorCartaoDistribuido($id_campanha);
	public function autalizarImagemCampanha($id_campanha, $nomearquivo);
	public function atualizarTotalLike($idcampanha, $idusuario, $islike);
	public function listarCampanhasParticipantes($id_campanha, $id_usuario, $pag);
	public function adicionarMaisCartoes($id_campanha, $id_usuario);
	public function criarCampanhaCarimbosPendentesProduzir($id_usuario, $id_campanha);



}


?>