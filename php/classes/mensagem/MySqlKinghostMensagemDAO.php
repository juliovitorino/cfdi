<?php

/**
 * MySqlKinghostMensagemDAO - Implementação DAO para usuário
 */

require_once 'MensagemDAO.php';
require_once 'DmlSqlMensagem.php';
require_once 'MensagemDTO.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostMensagemDAO implements MensagemDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto) {	}
	public function delete($dto) {	}
	public function update($dto) {	}
	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}


	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadPK($id)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlMensagem::SELECT . ' WHERE ' . DmlSqlMensagem::MENS_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* loadCodigoMensagem() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadCodigoMensagem($msgcodigo)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlMensagem::SELECT . ' WHERE ' . DmlSqlMensagem::MENS_TX_MSGCODE . '=' . "'" . $msgcodigo . "'"  );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* load() - Leitura da base
	* @param $dto - SessaoDTO
	*/
	public function load($dto) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlMensagem::SELECT . ' WHERE ' . DmlSqlMensagem::MENS_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* listMensagensStatus() - listagem de registros com status ativos
	* @param $status
	*/
	public function listMensagensStatus($status)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlMensagem::SELECT . ' WHERE `' . DmlSqlMensagem::MENS_IN_STATUS . '` =' . "'" . $status . "'");
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new MensagemDTO();
		$retorno->id = $resultset[DmlSqlMensagem::MENS_ID];
		$retorno->msgcodigo = $resultset[DmlSqlMensagem::MENS_TX_MSGCODE];
		$retorno->msg = $resultset[DmlSqlMensagem::MENS_TX_MENSAGEM];
		$retorno->status = $resultset[DmlSqlMensagem::MENS_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlMensagem::MENS_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlMensagem::MENS_DT_UPDATE];

		return $retorno;
	}

}
