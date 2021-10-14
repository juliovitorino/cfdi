<?php

require_once '../interfaces/AppService.php';

interface UsuarioService extends AppService{

	// métodos

	public function habilitarContaPorEmail($token);
	public function cadastrarNovaConta($dto, $planoid);
	public function cadastrarNovaContaFacebook($dto);
	public function pesquisarPorIdFacebook($id);
	public function getToken($dto);
	public function pesquisarPerfilCompleto($id);

}


?>