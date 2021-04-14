<?php

//importar dependencias
require_once 'cfdiService.php';
require_once 'cfdiBusinessImpl.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
 * CfdiServiceImpl - Implementação dos servicos
 */
class CfdiServiceImpl implements CfdiService
{
	
	function __construct() {	}

	public function apagar($dto) {	}
	public function pesquisar($dto) {	}
	public function atualizar($dto) {	}
	public function listarTudo() {	}

	public function cadastrar($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CfdiBusinessImpl();
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

	public function listarPagina($pag, $qtde)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CfdiBusinessImpl();
 			$retorno = $bo->listarPagina($daofactory, $pag, $qtde);
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


	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CfdiBusinessImpl();
 			$retorno = $bo->carregarPorID($daofactory, $id);
 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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

	public function pesquisarPorCarimbo($qrc)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CfdiBusinessImpl();
 			$retorno = $bo->carregarPorCarimbo($daofactory, $qrc);
 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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