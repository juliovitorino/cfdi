<?php

/**
 * MySqlKinghostProjetoTecnicaDAO - Implementação DAO para projetos x itens
 */

require_once 'ProjetoTecnicaDAO.php';
require_once 'ProjetoTecnicaDTO.php';
require_once 'DmlSqlProjetoTecnica.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostProjetoTecnicaDAO implements ProjetoTecnicaDAO
{
	private $daofactory;

	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}
	
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
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoTecnica::SELECT . ' WHERE ' . DmlSqlProjetoTecnica::PRTE_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* load() - Leitura da base de usuários
	* @param $dto - UsuarioDTO
	*/
	public function load($dto) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoTecnica::SELECT . ' WHERE ' . DmlSqlProjetoTecnica::PRTE_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	public function listTecnicas($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoTecnica::SELECT . ' WHERE `' . DmlSqlProjetoTecnica::PROJ_ID . '` =' . $idProjeto);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
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
