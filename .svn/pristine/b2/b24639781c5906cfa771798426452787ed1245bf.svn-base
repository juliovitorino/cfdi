<?php

/**
 * MySqlProjetoDorDAO - Implementação DAO para projetos x dores
 */

require_once 'ProjetoDorDAO.php';
require_once 'ProjetoDorDTO.php';
require_once 'DmlSqlProjetoDor.php';

require_once '../daofactory/DmlSql.php';

class MySqlProjetoDorDAO implements ProjetoDorDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto)
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoDor::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE
							.DmlSql::STRING_TYPE, $dto->projetoid, $dto->desc );
		$retorno = $stmt->execute();

		return $retorno;
	}

	public function delete($dto) 
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoDor::DEL_WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto );
		$retorno = $stmt->execute();

		return $retorno;

	}

	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto
	*/
	public function loadPK($id)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoDor::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}

	/**
	* load() - Leitura da base de usuários
	* @param $dto - UsuarioDTO
	*/
	public function load($dto) 
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoDor::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}

	public function listDores($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoDor::WHERE_PROJETOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $idProjeto );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			array_push($retorno, $this->getDTO($row));
		}
		return $retorno;
	}

	public function update($dto) {	}

	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new ProjetoDorDTO();
		$retorno->id = $resultset[DmlSqlProjetoDor::PRDO_ID];
		$retorno->projetoid = $resultset[DmlSqlProjetoDor::PROJ_ID];
		$retorno->desc = $resultset[DmlSqlProjetoDor::PRDO_TX_DOR];
		$retorno->dataCadastro = $resultset[DmlSqlProjetoDor::PRDO_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjetoDor::PRDO_DT_UPDATE];

		return $retorno;
	}

}
?>

