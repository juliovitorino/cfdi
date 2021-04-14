<?php

require_once '../interfaces/AppService.php';

/**
 * 
 * PlanoUsuarioFaturaService - Interface de metodos
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 18/08/2018
 */

interface PlanoUsuarioFaturaService extends AppService
{
	public function atualizarStatusPlanoUsuarioFaturaPorId($plufid, $status);
	public function aprovarPagamentoLiberarPlanoUsuarioFaturaPorId($plufid);
	public function pesquisarPlanoUsuarioPorStatus($usuarioid, $status);


}


?>