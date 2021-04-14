<?php
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
 * 
 * BacklinkBusiness
 */

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaBusiness extends BusinessObject
{
	public function listarCampanhasUsuario($daofactory, $id_usuario);
	public function isCampanhaAtiva($daofactory, $idcampanha);
	public function atualizarStatus($daofactory, $idcampanha, $status);
	public function listarCampanhasPorStatus($daofactory, $status);
	public function atualizarProximoQrCode($daofactory, $idcampanha, $caqrid);
	public function atualizarTotalCarimbosFabricados($daofactory, $idcampanha, $totalFabricar);
	public function getCarimboLivre($daofactory, $idcampanha, $idusuario);
	public function inserirFlash($daofactory, $dto);
	public function atualizarAcumuladoTicketMedio($daofactory, $idcampanha);
	public function incrementarContadorCartaoDistribuido($daofactory, $id_campanha);
	public function autalizarImagemCampanha($daofactory, $id_campanha, $nomearquivo);
	public function atualizarTotalLike($daofactory, $id_campanha, $idusuario, $islike);
	public function atualizarTotalStar($daofactory, $id_campanha, $idusuario, $star);
	public function atualizarControladorMaximoSelos($daofactory, $idcampanha);
	public function listarCampanhasParticipantes($daofactory, $id_campanha, $id_usuario, $pag);
	public function adicionarMaisCartoes($daofactory, $id_campanha, $id_usuario);
	public function atualizarTotalCarimbosAdicionados($daofactory, $id_campanha, $qtde);
	public function atualizarTotalCartoesAdicionados($daofactory, $id_campanha, $qtde);

	
	public function atualizarPermissaoCashbackPorPK($daofactory, $id_campanha, $permissao);
	public function listarCampanhasUsuarioStatus($daofactory, $id_usuario, $status);

}

?>
