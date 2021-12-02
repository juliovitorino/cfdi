<?php

require_once '../interfaces/DAO.php';
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
 * CampanhaDAO - Extensão da interface padrão de DAO
 */
interface CampanhaDAO extends DAO
{
	public function loadMaxCampanhaID($id_usuario);
	public function listCampanhasUsuario($id_usuario);
	public function updateStatus($id, $status);
	public function listCampanhasStatus($status);
	public function listCampanhasGMapsStatus($status);
	public function updateProximoQrCode($idcampanha, $caqrid);
	public function updateTotalCarimbosFabricados($idcampanha, $total);
	public function updateTotalCarimbados($idcampanha);
	public function updateProximoCarimboLivre($idcampanha, $caqrid);
	public function insertFlash($dto);
	public function updateAcumuladoTicketMedio($idcampanha, $vlticket);
	public function updateTotalCartoesDistribuidos($idcampanha);
	public function updateControladorMaximoSelos($idcampanha);
	public function updateImagemCampanha($idcampanha, $nomearquivo);
	public function updateTotalLike($idcampanha, $idusuario, $islike);
	public function updateTotalStar($idcampanha, $idusuario, $star);
	public function updateRating($idcampanha, $rating);
	public function updatePermissaoCashbackPorPK($idcampanha, $permissao);
	public function listCampanhasUsuarioStatus($id_usuario, $status);
	public function updateTotalCarimbosAdicionados($id_campanha, $qtde);
	public function updateTotalCartoesAdicionados($id_campanha, $qtde);
	public function countCampanhaPorUsuaId($usuaid);

}
?>