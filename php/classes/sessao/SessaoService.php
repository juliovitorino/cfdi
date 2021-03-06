<?php

require_once '../interfaces/AppService.php';

/**
 * SessaoService - Interface de serviços
 */
interface SessaoService extends AppService{

	public function autenticarUsuario($usuario, $senha);
	public function autenticarUsuarioApp($usuario, $senha, $manterconectado, $versao);
	public function autenticarUsuarioFacebook($idfcbk, $nome, $email, $urlfoto, $versao);
	public function autenticarTokenSessao($token);
	public function obterRegistroDonoTokenSessao($token);
}


?>