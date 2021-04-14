<?php

/**
 * 
 * PlanoUsuarioFaturaBusiness - Interface de metodos
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 18/08/2018
 */

require_once '../interfaces/BusinessObject.php';

interface PlanoUsuarioFaturaBusiness extends BusinessObject
{
	public function atualizarStatusPlanoUsuarioFaturaPorId($daofactory, $plufid, $status);
	public function aprovarPagamentoLiberarPlanoUsuarioFaturaPorId($daofactory, $plufid, $status);
	public function carregarPlanoUsuarioFaturaPorStatus($daofactory, $plusid, $status);
	public function liquidarPlanoUsuarioFaturaPorStatus($daofactory, $plufid, $status);
	public function carregarPlanoUsuarioFaturaMaisRecente($daofactory, $plusid);

}

?>