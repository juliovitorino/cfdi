<?php

/**
 * 
 * SessaoService - Classe de Serviços de Sessão de Usuário
 *
 * @author Julio Vitorino
 * @since 27/07/2018
 */

// importar dependências
require_once 'MensagemDTO.php';
require_once 'MensagemService.php';
require_once 'MensagemBusiness.php';
require_once 'MensagemBusinessImpl.php';

require_once '../daofactory/DAOFactory.php';

class MensagemServiceImpl implements MensagemService
{
	
	function __construct()
	{
		# code...
	}
	public function pesquisar($dto)	{	}
	public function atualizar($dto)	{	}
	public function listarTudo()	{	}
	public function cadastrar($dto)	{	}
	public function apagar($dto)	{	}
	public function pesquisarPorID($id) {	}
	public function listarPagina($pag, $qtde)	{	}

	public function listarTodasMensagens($status)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new MensagemBusinessImpl();
			$retorno = $sbi->listarTodasMensagens($daofactory, $status);
			
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