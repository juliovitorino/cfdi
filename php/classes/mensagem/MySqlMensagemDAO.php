<?php

/**
 * MySqlSessaoDAO - Implementação DAO para usuário
 */

require_once 'MensagemDAO.php';
require_once 'DmlSqlMensagem.php';
require_once 'MensagemDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlMensagemDAO implements MensagemDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto) {	}
	public function delete($dto) {	}
	public function update($dto) {	}


	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadPK($id)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlMensagem::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* loadCodigoMensagem() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadCodigoMensagem($msgcodigo)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlMensagem::WHERE_UIX);
		$stmt->bind_param(DmlSql::STRING_TYPE, $msgcodigo );
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
		$stmt = $conexao->prepare(DmlSqlMensagem::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

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
		$stmt = $conexao->prepare(DmlSqlMensagem::WHERE_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE, $status );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			array_push($retorno, $this->getDTO($row));
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
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
