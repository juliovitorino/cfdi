<?php

/**
 * 
 * PlanoUsuarioFaturaServiceImpl - Classe de Serviços
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */

// importar dependências
require_once 'PlanoUsuarioFaturaDTO.php';
require_once 'PlanoUsuarioFaturaBusinessImpl.php';
require_once 'PlanoUsuarioFaturaService.php';

require_once '../daofactory/DAOFactory.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/ConstantesMensagem.php';

class PlanoUsuarioFaturaServiceImpl implements PlanoUsuarioFaturaService
{
	
	function __construct()
	{
		# code...
	}


	public function apagar($dto)	{	}
	public function pesquisar($dto)	{	}
	public function atualizar($dto)	{	}
	public function listarTudo()	{	}
	public function listarPagina($pag, $qtde)	{	}

	/**
	*
	* cadastrar() - Cadastrar um registro
	* @param $dto
	* @return $dto
	*/
	public function cadastrar($dto)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new PlanoUsuarioFaturaBusinessImpl();
			$retorno = $sbi->inserir($daofactory, $dto);
			
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
	* atualizarStatusPlanoUsuarioFaturaPorId() - Atualiza status
	* @param integer
	* @param string
	* @return integer
	*/
	public function atualizarStatusPlanoUsuarioFaturaPorId($plufid, $status)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new PlanoUsuarioFaturaBusinessImpl();
			$retorno = $sbi->atualizarStatusPlanoUsuarioFaturaPorId($daofactory, $plufid, $status);
			
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
	
	public function aprovarPagamentoLiberarPlanoUsuarioFaturaPorId($plufid)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new PlanoUsuarioFaturaBusinessImpl();
			$retorno = $sbi->aprovarPagamentoLiberarPlanoUsuarioFaturaPorId($daofactory, $plufid, ConstantesVariavel::STATUS_APROVADO);
			
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
	* pesquisarPlanoUsuarioPorStatus() - Recuperar plano ativo
	* @param integer
	* @param string
	* @return integer
	*/
	public function pesquisarPlanoUsuarioPorStatus($usuarioid, $status)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new PlanoUsuarioFaturaBusinessImpl();
			$retorno = $sbi->carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, $status);
			
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
			$sbi = new PlanoUsuarioFaturaBusinessImpl();
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