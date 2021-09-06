<?php

/**
 * 
 * UsuarioServiceImpl - Classe de Serviços para Usuário
 *
 * @author Julio Vitorino
 * @since 27/07/2018
 */

// importar dependências
require_once 'UsuarioBusiness.php';
require_once 'ProjetoDTO.php';
require_once 'UsuarioService.php';
require_once 'UsuarioBusinessImpl.php';

require_once '../mensagem/MensagemCache.php';
require_once '../mensagem/ConstantesMensagem.php';

require_once '../daofactory/DAOFactory.php';

class UsuarioServiceImpl implements UsuarioService
{
	
	function __construct()	{	}

	public function apagar($dto) {}
	public function listarPagina($pag, $qtde)	{	}

	public function habilitarContaPorEmail($token)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->habilitarContaPorEmail($daofactory, $token);

			$daofactory->commit();
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function cadastrarNovaContaFacebook($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->inserirNovaContaFacebook($daofactory
 						, $dto
 						, VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function pesquisarPerfilCompleto($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->pesquisarPerfilCompleto($daofactory, $id);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function cadastrarNovaConta($dto, $planoid)
	{

		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->inserirNovaConta($daofactory, $dto, $planoid);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

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
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->inserir($daofactory, $dto);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function pesquisarPorIdFacebook($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->carregarPorIDFacebook($daofactory, $id);
			$daofactory->commit();
			
			//$retorno->msgcode = MSGCODE.INSCRICAO_REALIZADA_SUCESSO;
			//$retorno->msgcodeString = MensagemCache.getInstance().getMensagem(MSGCODE.INSCRICAO_REALIZADA_SUCESSO);
			
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


	public function pesquisarPorId($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->carregarPorID($daofactory, $id);
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
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioBusinessImpl();
 			$retorno = $bo->carregar($daofactory, $dto);
			$daofactory->commit();
			
			//$retorno->msgcode = MSGCODE.INSCRICAO_REALIZADA_SUCESSO;
			//$retorno->msgcodeString = MensagemCache.getInstance().getMensagem(MSGCODE.INSCRICAO_REALIZADA_SUCESSO);
			
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

	public function atualizar($dto)
	{

	}

	public function listarTudo()
	{

	}

	public function getToken($dto) {
		// cria um token
		$dt = new DateTime();
		$str = $dto->usuario->email.$dt->getTimestamp();
		return sha1($str);
	}

	private function apagarSessao() {
		$_SESSION = array();
	}

	private function validarSenha($pwd, $pwdArmazenada){
		// retorno padrão é negado
		$retorno = false;

		// Aplica algoritimo sha1
		$pwdsha1 = sha1($pwd);

		if ($pwdsha1 == $pwdArmazenada) {
			$retorno = true;
		}

		// retorno
		return $retorno;
	}
}

?>