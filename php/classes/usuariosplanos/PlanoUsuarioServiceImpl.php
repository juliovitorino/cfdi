<?php

/**
 * 
 * PlanoUsuarioServiceImpl - Classe de Serviços
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */

// importar dependências
require_once 'PlanoUsuarioDTO.php';
require_once 'PlanoUsuarioBusinessImpl.php';
require_once 'PlanoUsuarioService.php';

require_once '../dto/DTOPadrao.php';
require_once '../daofactory/DAOFactory.php';
require_once '../mensagem/ConstantesMensagem.php';

class PlanoUsuarioServiceImpl implements PlanoUsuarioService
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
	* verificarPermissaoPlano() - Verifica da permissão do plano ativo
	* @param $usuarioid
	* @return PermissaoDTO
	*/
	public function verificarPermissaoPlano($usuarioid, $funcionalidade)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new PlanoUsuarioBusinessImpl();
			$retorno = $sbi->verificarPermissaoPlano($daofactory, $usuarioid, $funcionalidade);
			
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
			$sbi = new PlanoUsuarioBusinessImpl();
			$retorno = $sbi->inserir($daofactory, $dto);
			
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

	/**
	*
	* atualizarPlanoUsuarioPorId() - Recuperar plano ativo
	* @param integer
	* @param string
	* @return integer
	*/
	public function atualizarPlanoUsuarioPorId($plusid, $status)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			$sbi = new PlanoUsuarioBusinessImpl();
			$retorno = $sbi->atualizarPlanoUsuarioPorId($daofactory, $plusid, $status);
			
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

	/**
	*
	* pesquisarPlanoUsuarioPorStatus() - Recuperar plano ativo
	* @param integer
	* @param string
	* @return integer
	*/
	public function pesquisarPlanoUsuarioAtivo($usuarioid)
	{
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$pusi = new PlanoUsuarioServiceImpl();
		$plus_id_ativo = $this->pesquisarPlanoUsuarioPorStatus($usuarioid, ConstantesVariavel::STATUS_ATIVO);
		if($plus_id_ativo == null){
			return $retorno;
		}
		$plusdto = $this->pesquisarPorID($plus_id_ativo);
		return $plusdto;
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
			$sbi = new PlanoUsuarioBusinessImpl();
			$retorno = $sbi->carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, $status);
			
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
			$sbi = new PlanoUsuarioBusinessImpl();
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


}

?>