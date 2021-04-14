<?php

/**
 * 
 * UsuarioTrocaSenhaHistoricoServiceImpl - Classe de Serviços
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */

// importar dependências
require_once 'UsuarioTrocaSenhaHistoricoDTO.php';
require_once 'UsuarioTrocaSenhaHistoricoBusinessImpl.php';
require_once 'UsuarioTrocaSenhaHistoricoService.php';

require_once '../daofactory/DAOFactory.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/ConstantesMensagem.php';

class UsuarioTrocaSenhaHistoricoServiceImpl implements UsuarioTrocaSenhaHistoricoService
{
	
	function __construct()
	{
		# code...
	}


	public function apagar($dto)	{	}
	public function pesquisar($dto)	{	}
	public function atualizar($dto)	{	}
	public function listarTudo()	{	}
	public function cadastrar($dto)	{	}
	public function listarPagina($pag, $qtde)	{	}

	public function trocarSenhar($usuarioid, $pwd1, $pwd2, $token)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new UsuarioTrocaSenhaHistoricoBusinessImpl();
			$retorno = $sbi->trocarSenhar($daofactory, $usuarioid, $pwd1, $pwd2, $token);
			
			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
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


	/**
	* esquecerSenha() - Implementação do processo esqueceu sua senha
	* @param $dto
	* @return $dto
	*/
	public function esquecerSenha($email)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new UsuarioTrocaSenhaHistoricoBusinessImpl();
			$retorno = $sbi->esquecerSenha($daofactory, $email);
			
			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
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


	/**
	*
	* pesquisarPorID() - Pesquisa o registro pela id
	* @param $id
	* @return $dto
	*/
	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new UsuarioTrocaSenhaHistoricoBusinessImpl();
			$retorno = $sbi->carregarPorID($daofactory, $id);
			
			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
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


}

?>