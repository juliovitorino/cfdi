<?php

/**
 * 
 * PlanoUsuarioBusiness - Interface de metodos
 * @author Julio Vitorino
 * @copyright Julio Vitroino
 * @since 19/08/2018
 */

require_once '../interfaces/BusinessObject.php';

interface PlanoUsuarioBusiness extends BusinessObject
{
	public function carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, $status);
	public function atualizarPlanoUsuarioPorId($daofactory, $plusid, $status);
	public function verificarPermissaoPlano($daofactory, $usuarioid, $funcionalidade);

}

?>