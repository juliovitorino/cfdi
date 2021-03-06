<?php

require_once '../interfaces/DAO.php';

/**
 * UsuarioDAO - Extensão da interface padrão de DAO
 */
interface UsuarioDAO extends DAO
{
	public function loadUsuarioLogin($idUsuario);
	public function loadUsuarioPorCodigoAtivacao($token);
	public function loadIDFacebook($id);
	public function updateLiberarContaUsuario($token);
	public function updateNovaSenha($usuarioid, $pwd);
	public function insertUsuarioFacebook($dto);
	public function updateFotoPerfil($usuaid, $urlfoto);


}
?>