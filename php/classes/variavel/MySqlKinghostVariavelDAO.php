<?php

/**
 * MySqlKinghostVariavelDAO - Implementação DAO para usuário
 */

require_once 'VariavelDAO.php';
require_once 'DmlSqlVariavel.php';
require_once 'VariavelDTO.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostVariavelDAO implements VariavelDAO
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
		$res = $conexao->query(DmlSqlVariavel::SELECT . ' WHERE ' . DmlSqlVariavel::VARI_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* loadCodigoVariavel() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadCodigoVariavel($codigo)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlVariavel::SELECT . ' WHERE ' . DmlSqlVariavel::VARI_NM_VARIAVEL . '=' . "'" . $codigo . "'" );
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
		$res = $conexao->query(DmlSqlVariavel::SELECT . ' WHERE ' . DmlSqlVariavel::VARI_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* listVariavelStatus() - listagem de registros com status ativos
	* @param $status
	*/
	public function listVariavelStatus($status)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlVariavel::SELECT . ' WHERE `' . DmlSqlVariavel::VARI_IN_STATUS . '` =' . "'" . $status . "'");
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
		$retorno = new VariavelDTO();
		$retorno->id = $resultset[DmlSqlVariavel::VARI_ID];
		$retorno->variavel = $resultset[DmlSqlVariavel::VARI_NM_VARIAVEL];
		$retorno->descricao = $resultset[DmlSqlVariavel::VARI_TX_DESCRICAO];
		$retorno->conteudo = $resultset[DmlSqlVariavel::VARI_TX_VALOR_CONTEUDO];
		$retorno->status = $resultset[DmlSqlVariavel::VARI_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlVariavel::VARI_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlVariavel::VARI_DT_UPDATE];

		return $retorno;
	}

}

