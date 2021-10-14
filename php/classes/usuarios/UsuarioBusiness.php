<?php

/**
 * 
 * UsuariosBusiness
 */

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioBusiness extends BusinessObject
{
	public function inserirNovaConta($daofactory, $dto, $planoid);
	public function inserirNovaContaFacebook($daofactory, $dto);
	public function habilitarContaPorEmail($daofactory, $token);
	public function inserirProjeto($daofactory, $projetodto);
	public function inserirProjetoItem($daofactory, $idProjeto, $descricao, $tipoItem);
	public function deletarProjetoItem($daofactory, $idpk, $tipoItem);
	public function atualizarProjeto($daofactory, $projetodto);
	public function carregarUsuarioPorID($daofactory, $idUsuario);
	public function carregarPorIDFacebook($daofactory, $id);
	public function carregarUsuarioProjeto($daofactory, $idUsuario, $idProjeto);
	public function carregarUsuarioPeloProjeto($daofactory, $idProjeto);
	public function carregarUsuarioPorLogin($daofactory, $email);
	public function buscarTodosProjetos($daofactory, $idUsuario);
	public function buscarTodosBonus($daofactory, $idProjeto);
	public function buscarTodosItens($daofactory, $idProjeto);
	public function buscarTodasDores($daofactory, $idProjeto);
	public function buscarTodosBeneficios($daofactory, $idProjeto);
	public function buscarTodasTecnicas($daofactory, $idProjeto);
	public function atualizarFotoPerfilRedeSocial($daofactory, $email, $urlfoto);
	public function pesquisarPerfilCompleto($daofactory, $id);

}

?>
