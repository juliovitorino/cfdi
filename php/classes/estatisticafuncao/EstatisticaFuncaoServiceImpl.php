<?php

//importar dependencias
require_once 'EstatisticaFuncaoService.php';
require_once 'EstatisticaFuncaoBusinessImpl.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
 * EstatisticaFuncaoServiceImpl - Implementação dos servicos
 */
class EstatisticaFuncaoServiceImpl implements EstatisticaFuncaoService
{
	
	function __construct() {	}

	public function apagar($dto) {	}
	public function pesquisar($dto) {	}
	public function atualizar($dto) {	}
	public function listarTudo() {	}
	public function listarPagina($pag, $qtde)	{	}


	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new EstatisticaFuncaoBusinessImpl();
 			$retorno = $bo->carregarPorID($daofactory, $id);
			$daofactory->commit();
			
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO);
			
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

	public function pesquisarPorUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new EstatisticaFuncaoBusinessImpl();
 			$retorno = $bo->pesquisarPorUIX($daofactory, $tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
			$daofactory->commit();
			
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO);
			
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

	public function incrementarQtdePorID($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new EstatisticaFuncaoBusinessImpl();
 			$retorno = $bo->incrementarQtdePorID($daofactory, $id);
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


	public function incrementarQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new EstatisticaFuncaoBusinessImpl();
 			$retorno = $bo->incrementarQtde($daofactory, $tipo, $dia, $mes, $ano, $usuarioid, $projetoid);
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
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new EstatisticaFuncaoBusinessImpl();
 			$retorno = $bo->inserir($daofactory, $dto);
			$daofactory->commit();
			
			//$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			//$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO);
			
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