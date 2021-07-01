<?php

/**
 * MySqlKinghostProjetoDorDAO - Implementação DAO para projetos x dores
 */

require_once 'ProjetoDorDAO.php';
require_once 'ProjetoDorDTO.php';
require_once 'DmlSqlProjetoDor.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostProjetoDorDAO implements ProjetoDorDAO
{
	private $daofactory;

	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto) {	}

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
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoDor::SELECT . ' WHERE ' . DmlSqlProjetoDor::PRDO_ID . '=' . $id );
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
		$res = $conexao->query(DmlSqlProjetoDor::SELECT . ' WHERE ' . DmlSqlProjetoDor::PRDO_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	public function listDores($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoDor::SELECT . ' WHERE `' . DmlSqlProjetoDor::PROJ_ID . '` =' . $idProjeto);
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
		$retorno = new ProjetoDorDTO();
		$retorno->id = $resultset[DmlSqlProjetoDor::PRDO_ID];
		$retorno->projetoid = $resultset[DmlSqlProjetoDor::PROJ_ID];
		$retorno->desc = $resultset[DmlSqlProjetoDor::PRDO_TX_DOR];
		$retorno->dataCadastro = $resultset[DmlSqlProjetoDor::PRDO_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjetoDor::PRDO_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

}
?>

