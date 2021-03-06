<?php

/**
 * 
 * SessaoService - Classe de Serviços de Sessão de Usuário
 *
 * @author Julio Vitorino
 * @since 27/07/2018
 */

// importar dependências
require_once 'SessaoDTO.php';
require_once 'ConstantesSessao.php';
require_once 'SessaoService.php';
require_once 'SessaoBusiness.php';
require_once 'SessaoBusinessImpl.php';

require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../usuarios/UsuarioDTO.php';
require_once '../usuariocomplemento/usuarioComplementoBusinessImpl.php';
require_once '../usuariocomplemento/usuarioComplementoDTO.php';

class SessaoServiceImpl implements SessaoService
{
	
	function __construct()
	{
		# code...
	}
	public function listarPagina($pag, $qtde)	{	}

	public function autenticarUsuarioFacebook($idfcbk, $nome, $email, $urlfoto, $versao)
	{
		$daofactory = NULL;
		$retorno = new DTOPadrao();
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new SessaoBusinessImpl();
			$retorno = $sbi->validarRegrasAutenticacaoFacebook($daofactory, $idfcbk, $nome, $email, $versao);

			if ($retorno->msgcode == ConstantesMensagem::NOVO_USUARIO_FACEBOOK_AUTENTICADO){
				$ubi = new UsuarioBusinessImpl();
				$dto = new UsuarioDTO();
				$dto->iduserfacebook = $idfcbk;
				$dto->email = $email;
				$dto->apelido = $nome;
				$dto->tipoConta = 'C';
				$dto->urlfoto = $urlfoto;
				$dto->pwd = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::AUTENTICACAO_AUTORIZADA_FACEBOOK);
				$retorno = $ubi->inserirNovaContaFacebook($daofactory,$dto);
				$retorno = $sbi->validarRegrasAutenticacaoFacebook($daofactory, $idfcbk, $nome, $email, $versao);
		
				// Insere um registro 1:1 na usuário complemento
				$uscobo = new UsuarioComplementoBusinessImpl();
				$uscodto = new UsuarioComplementoDTO();
				$uscodto->idUsuario = $retorno->usuariodto->id;
				$uscobo->inserirUsuarioComplemento($daofactory, $uscodto);
			}

			// Atualiza foto do perfil da rede social se diferente da atual
			$usuabo = new UsuarioBusinessImpl();
			$usuabo->atualizarFotoPerfilRedeSocial($daofactory, $email, $urlfoto);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) 
 			{
				$daofactory->commit();
 			} else {
				$daofactory->rollback();
 			}
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function autenticarUsuarioApp($usuario, $senha, $manterconectado, $versao)
	{
		$daofactory = NULL;
		$retorno = new DTOPadrao();
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new SessaoBusinessImpl();
			$retorno = $sbi->validarRegrasAutenticacaoApp($daofactory, $usuario, $senha, $manterconectado, $versao);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) 
 			{
				$daofactory->commit();
 			} else {
				$daofactory->rollback();
 			}
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function autenticarUsuario($usuario, $senha)
	{
		$daofactory = NULL;
		$retorno = new DTOPadrao();
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new SessaoBusinessImpl();
			$retorno = $sbi->validarRegrasAutenticacao($daofactory, $usuario, $senha);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) 
 			{
				$daofactory->commit();
 			} else {
				$daofactory->rollback();
 			}
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function obterRegistroDonoTokenSessao($token)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new SessaoBusinessImpl();
			$retorno = $sbi->carregarPorToken($daofactory, $token);

			$daofactory->commit();
			
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function autenticarTokenSessao($token)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// aplica validação do token
			$sbi = new SessaoBusinessImpl();
			if ($sbi->validarToken($daofactory, $token)){
				$retorno = true;
			}
			
			$daofactory->commit();
			
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function cadastrar($dto)
	{

	}

	public function apagar($dto)
	{

	}

	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new SessaoBusinessImpl();
			$retorno = $sbi->carregarPorID($daofactory, $id);
			
			$daofactory->commit();
			
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function pesquisar($dto)
	{

	}

	public function atualizar($dto)
	{

	}

	public function listarTudo()
	{

	}


}

?>