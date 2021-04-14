<?php

/**
 * 
 * PlanoServiceImpl - Classe de Serviços
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */

// importar dependências
require_once 'PlanoDTO.php';
require_once 'PlanoBusinessImpl.php';
require_once 'PlanoService.php';

require_once '../daofactory/DAOFactory.php';
require_once '../mensagem/ConstantesMensagem.php';

class PlanoServiceImpl implements PlanoService
{
	
	function __construct()
	{
		# code...
	}


	public function cadastrar($dto)	{	}
	public function apagar($dto)	{	}
	public function pesquisar($dto)	{	}
	public function atualizar($dto)	{	}
	public function listarTudo()	{	}
	public function listarPagina($pag, $qtde)	{	}
	

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
			$sbi = new PlanoBusinessImpl();
			$retorno = $sbi->carregarPorID($daofactory, $id);

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