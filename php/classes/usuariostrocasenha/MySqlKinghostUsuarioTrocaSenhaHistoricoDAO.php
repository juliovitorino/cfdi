<?php

/**
 * MySqlKinghostUsuarioTrocaSenhaHistoricoDAO - Implementação DAO
 */

require_once 'UsuarioTrocaSenhaHistoricoDAO.php';
require_once 'DmlSqlUsuarioTrocaSenhaHistorico.php';
require_once 'UsuarioTrocaSenhaHistoricoDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostUsuarioTrocaSenhaHistoricoDAO implements UsuarioTrocaSenhaHistoricoDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function delete($dto) {	}
	public function update($dto) {	}
	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}

	public function updateTokenStatus($utshid, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioTrocaSenhaHistorico::UPD_PK_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							, $status
							, $utshid);

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateUsuaIDTrocaStatus($usuarioid, $statusantigo, $statusnovo)
	{
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioTrocaSenhaHistorico::UPD_USUA_ID_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							, $statusnovo
							, $usuarioid
							, $statusantigo );

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function deleteUsuaIDStatus($usuarioid, $status)
	{
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioTrocaSenhaHistorico::DEL_USUA_ID_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							, $usuarioid
							, $status );

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateStatusUsuarioTrocaSenhaHistoricoPorId($id, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioTrocaSenhaHistorico::UPD_PK_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							, $status
							, $id );

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	

	public function insert($dto)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioTrocaSenhaHistorico::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							, $dto->usuarioid
							, $dto->token);
		if ($stmt->execute())
		{
			$retorno = true;
		}

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
		$res = $conexao->query(DmlSqlUsuarioTrocaSenhaHistorico::SELECT 
						. ' WHERE ' . DmlSqlUsuarioTrocaSenhaHistorico::UTSH_ID . '=' . $id );
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
		$res = $conexao->query(DmlSqlUsuarioTrocaSenhaHistorico::SELECT 
						. ' WHERE ' . DmlSqlUsuarioTrocaSenhaHistorico::UTSH_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* loadTrocaSenhaHistoricoPorUsuarioToken() - Leitura da base
	* @param $usuarioid
	* @param $token
	* @return $UsuarioTrocaSenhaHistoricoDTO
	*/
	public function loadTrocaSenhaHistoricoPorUsuarioToken($usuarioid, $token)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuarioTrocaSenhaHistorico::SELECT 
									. ' WHERE ' . DmlSqlUsuarioTrocaSenhaHistorico::USUA_ID . '=' . $usuarioid 
									. ' AND ' . DmlSqlUsuarioTrocaSenhaHistorico::UTSH_TX_TOKEN . '=' . "'". $token ."'" );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* loadUsuarioTrocaSenhaHistoricoPorToken() - Leitura da base
	* @param $usuarioid
	* @param $token
	* @return $UsuarioTrocaSenhaHistoricoDTO
	*/
	public function loadUsuarioTrocaSenhaHistoricoPorToken($token) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuarioTrocaSenhaHistorico::SELECT 
									. ' WHERE ' . DmlSqlUsuarioTrocaSenhaHistorico::UTSH_TX_TOKEN . '=' . "'". $token ."'" );
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
		$retorno = new UsuarioTrocaSenhaHistoricoDTO();
		$retorno->id = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::UTSH_ID];
		$retorno->usuarioid = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::USUA_ID];
		$retorno->token = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::UTSH_TX_TOKEN];
		$retorno->status = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::UTSH_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::UTSH_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlUsuarioTrocaSenhaHistorico::UTSH_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}
}
