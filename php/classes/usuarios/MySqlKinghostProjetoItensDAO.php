<?php

/**
 * MySqlKinghostProjetoItensDAO - Implementação DAO para projetos x itens
 */

require_once 'ProjetoItensDAO.php';
require_once 'ProjetoItemDTO.php';
require_once 'DmlSqlProjetoItens.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostProjetoItensDAO implements ProjetoItensDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto) {	}
	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}

	public function insert($dto)
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoItens::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE
							.DmlSql::STRING_TYPE, $dto->projetoid, $dto->desc );
		$retorno = $stmt->execute();

		return $retorno;
	}

	public function delete($dto) 
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoItens::DEL_WHERE_PK);
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
		$res = $conexao->query(DmlSqlProjetoItens::SELECT . ' WHERE ' . DmlSqlProjetoItens::PRIT_ID . '=' . $id );
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
		$res = $conexao->query(DmlSqlProjetoItens::SELECT . ' WHERE ' . DmlSqlProjetoItens::PRIT_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	public function listItens($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoItens::SELECT . ' WHERE `' . DmlSqlProjetoItens::PROJ_ID . '` =' . $idProjeto);
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
		$retorno = new ProjetoItemDTO();
		$retorno->id = $resultset[DmlSqlProjetoItens::PRIT_ID];
		$retorno->projetoid = $resultset[DmlSqlProjetoItens::PROJ_ID];
		$retorno->desc = $resultset[DmlSqlProjetoItens::PRIT_TX_ITEM];
		$retorno->dataCadastro = $resultset[DmlSqlProjetoItens::PRIT_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjetoItens::PRIT_DT_UPDATE];

		return $retorno;
	}

}
?>
