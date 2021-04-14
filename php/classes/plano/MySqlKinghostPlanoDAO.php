<?php

/**
 * MySqlKinghostPlanoDAO - Implementação DAO
 */

require_once 'PlanoDAO.php';
require_once 'DmlSqlPlano.php';
require_once 'PlanoDTO.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostPlanoDAO implements PlanoDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function delete($dto) {	}
	public function update($dto) {	}
	public function insert($dto) {	}
	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}

	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto
	*/
	public function loadPK($id)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* load() - Leitura da base
	* @param $dto
	*/
	public function load($dto) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new PlanoDTO();
		$retorno->id = $resultset[DmlSqlPlano::PLAN_ID];
		$retorno->nome = $resultset[DmlSqlPlano::PLAN_NM_PLANO];
		$retorno->permissao = $resultset[DmlSqlPlano::PLAN_TX_PERMISSAO];
		$retorno->valor = $resultset[DmlSqlPlano::PLAN_VL_PLANO];
		$retorno->tipo = $resultset[DmlSqlPlano::PLAN_IN_TIPO];
		$retorno->status = $resultset[DmlSqlPlano::PLAN_IN_STATUS];
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlano::PLAN_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlano::PLAN_DT_UPDATE]);

		return $retorno;
	}
}
