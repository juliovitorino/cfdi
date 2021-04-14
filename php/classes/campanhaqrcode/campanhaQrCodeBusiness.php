<?php

/**
 * 
 * BacklinkBusiness
 */

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaQrCodeBusiness extends BusinessObject
{
	public function listarPagina($daofactory, $pag, $qtde);
	public function atualizarStatusPorTicket($daofactory, $ticket, $status);
	public function atualizarStatusPorCarimbo($daofactory, $carimboqr, $status);
	public function carregarTicketLivre($daofactory, $ticket);
	public function carregarQRCodeLivre($daofactory, $qrc);
	public function carregarCaqrIdLivre($daofactory,$idcampanha);
	public function atualizarUsuarioGerador($daofactory,$caqrid,$idusuario);
	public function criarCarimbosCampanha($daofactory, $idcampanha, $id_usuario);
	public function criarCarimbosCampanhaPendentesProduzir($daofactory, $idcampanha, $id_usuario);
	public function adicionarMaisCarimbosCampanha($daofactory, $capeid);	

}

?>
