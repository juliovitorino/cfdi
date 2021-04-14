<?php

/**
 * MySqlProjetoItensDAO - Implementação DAO para projetos x itens
 */

require_once 'ProjetoTecnicaDAO.php';
require_once 'ProjetoTecnicaDTO.php';
require_once 'DmlSqlProjetoTecnica.php';

require_once '../daofactory/DmlSql.php';

class MySqlProjetoTecnicaDAO implements ProjetoTecnicaDAO
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
		$stmt = $conexao->prepare(DmlSqlProjetoTecnica::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE
							.DmlSql::STRING_TYPE, $dto->projetoid, $dto->desc );
		$retorno = $stmt->execute();

		return $retorno;
	}

	public function delete($dto) 
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoTecnica::DEL_WHERE_PK);
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
		$stmt = $conexao->prepare(DmlSqlProjetoTecnica::WHERE_PK);
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
		$stmt = $conexao->prepare(DmlSqlProjetoTecnica::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}

	public function listTecnicas($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoTecnica::WHERE_PROJETOS);
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
		$retorno = new ProjetoBeneficioDTO();
		$retorno->id = $resultset[DmlSqlProjetoTecnica::PRTE_ID];
		$retorno->projetoid = $resultset[DmlSqlProjetoTecnica::PROJ_ID];
		$retorno->desc = $resultset[DmlSqlProjetoTecnica::PRTE_TX_TECNICAS];
		$retorno->dataCadastro = $resultset[DmlSqlProjetoTecnica::PRTE_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjetoTecnica::PRTE_DT_UPDATE];

		return $retorno;
	}

}
?>
