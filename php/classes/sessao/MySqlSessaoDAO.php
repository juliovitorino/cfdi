<?php

/**
 * MySqlSessaoDAO - Implementação DAO para usuário
 */

require_once 'SessaoDAO.php';
require_once 'DmlSqlSessao.php';
require_once 'SessaoDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlSessaoDAO implements SessaoDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto) 
	{
		var_dump($dto);

		// prepara sessão, comando DML, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();

		if(is_null($conexao)){
			echo "ESTOU NULO :O";
		}

		var_dump(DmlSqlSessao::INS);
		var_dump($dto);
		
		$stmt = $conexao->prepare(DmlSqlSessao::INS);
		$stmt->bind_param(DmlSql::STRING_TYPE
							.DmlSql::INTEGER_TYPE
							.DmlSql::STRING_TYPE
							, $dto->tokenid
							, $dto->usuario
							, $dto->keep );
		return $stmt->execute();
	}

	public function delete($dto)
	{

	}

	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadPK($id)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlSessao::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* loadToken() - Leitura da base por token
	* @param $token - string
	*/
	public function loadToken($token)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlSessao::WHERE_TOKEN);
		$stmt->bind_param(DmlSql::STRING_TYPE, $token );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* load() - Leitura da base
	* @param $dto - SessaoDTO
	*/
	public function load($dto) 
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlSessao::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}


	public function update($dto)
	{
		/* Fetch result to array 
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			//array_push($a_data, $row);
			
		}
*/

	}


	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new SessaoDTO();
		$retorno->id = $resultset[DmlSqlSessao::SESS_ID];
		$retorno->usuario = $resultset[DmlSqlSessao::USUA_ID];
		$retorno->tokenid = $resultset[DmlSqlSessao::SESS_TX_HASH];
		$retorno->keep = $resultset[DmlSqlSessao::SESS_IN_MANTER_CONECTADO];
		$retorno->status = $resultset[DmlSqlSessao::SESS_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlSessao::SESS_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlSessao::SESS_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>