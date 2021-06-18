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

class MySqlKinghostSessaoDAO implements SessaoDAO
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

		// prepara sessão, comando DML, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();

		if(is_null($conexao)){
			echo "ESTOU NULO :O";
		}
	
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
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlSessao::SELECT . ' WHERE ' . DmlSqlSessao::SESS_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* loadToken() - Leitura da base por token
	* @param $token - string
	*/
	public function loadToken($token)
	{
		//var_dump($token);
		//var_dump(DmlSqlSessao::SELECT . ' WHERE ' . DmlSqlSessao::SESS_TX_HASH . '=' . "'" . $token . "'");
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlSessao::SELECT . ' WHERE ' . DmlSqlSessao::SESS_TX_HASH . '=' . "'" . $token . "'");
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		//var_dump($retorno);
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
		$res = $conexao->query(DmlSqlSessao::SELECT . ' WHERE ' . DmlSqlSessao::SESS_TX_HASH . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function update($dto)
	{

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
		$retorno->forcelogin = $resultset[DmlSqlSessao::SESS_IN_FORCAR_LOGIN];
		$retorno->status = $resultset[DmlSqlSessao::SESS_IN_STATUS];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSessao::SESS_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSessao::SESS_DT_UPDATE]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>