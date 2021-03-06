<?php

require_once '../interfaces/AppService.php';

/**
 * 
 * PlanoUsuarioService - Interface de metodos
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 19/08/2018
 */

interface PlanoUsuarioService extends AppService
{
	public function pesquisarPlanoUsuarioAtivo($usuarioid);
	public function pesquisarPlanoUsuarioPorStatus($usuarioid, $status);
	public function atualizarPlanoUsuarioPorId($plusid, $status);
	public function verificarPermissaoPlano($usuarioid, $funcionalidade);

}


?>