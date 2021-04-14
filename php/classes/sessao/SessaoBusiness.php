<?php

/**
 * 
 * SessaoBusiness
 */

require_once '../interfaces/BusinessObject.php';
require_once '../daofactory/DAOFactory.php';
require_once '../usuarios/UsuarioDAO.php';

interface SessaoBusiness extends BusinessObject
{
	public function validarSenha($usuario, $senha);
	public function validarToken($daofactory, $token);
	public function carregarPorToken($daofactory, $token);
	public function validarRegrasAutenticacao($daofactory, $usuario, $senha);
	public function validarRegrasAutenticacaoFacebook($daofactory, $idfcbk, $nome, $email, $versao);
	public function validarRegrasAutenticacaoApp($daofactory, $usuario, $senha, $manterconectado, $versao);


}

?>