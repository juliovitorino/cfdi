<?php
// importar dependências
require_once 'VariavelDTO.php';
require_once 'VariavelService.php';
require_once 'VariavelBusiness.php';
require_once 'VariavelBusinessImpl.php';

require_once '../daofactory/DAOFactory.php';

/**
 * 
 * SessaoService - Classe de Serviços de Sessão de Usuário
 *
 * @author Julio Vitorino
 * @since 27/07/2018
 */

class VariavelServiceImpl implements VariavelService
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

	public function listarTodasVariaveis($status)
	{
		$daofactory = NULL;
		$retorno = false;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Recupera Sessão usando o token
			$sbi = new VariavelBusinessImpl();
			$retorno = $sbi->listarTodasVariaveis($daofactory, $status);
			
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