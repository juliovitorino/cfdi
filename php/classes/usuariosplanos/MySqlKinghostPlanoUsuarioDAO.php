<?php

/**
 * MySqlKinghostPlanoUsuarioDAO - Implementação DAO
 */

require_once 'PlanoUsuarioDAO.php';
require_once 'DmlSqlPlanoUsuario.php';
require_once 'PlanoUsuarioDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostPlanoUsuarioDAO implements PlanoUsuarioDAO
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

	public function insert($dto)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlPlanoUsuario::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::DOUBLE_TYPE 
							, $dto->usuarioid
							, $dto->planoid 
							, $dto->nome
							, $dto->permissao
							, $dto->valor );

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	
	public function updatePlanoUsuarioPorId($plusid, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlPlanoUsuario::WHERE_PK_UPD_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							, $status
							, $plusid );

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	
	public function loadPlanoUsuarioPorStatus($usuarioid, $status)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$sql = DmlSqlPlanoUsuario::SELECT_MAX_PLUS_ID 
		. ' WHERE ' . DmlSqlPlanoUsuario::USUA_ID . '=' . $usuarioid 
		. ' AND ' . DmlSqlPlanoUsuario::PLUS_IN_STATUS . '=' . "'". $status ."'" ;

		$res = $conexao->query($sql);
		if ($res){
			$row = $res->fetch_assoc();
			foreach ($row as $key => $value) {
				$retorno = $value;
			}
		} else {
			$retorno = -1;
		}
		return $retorno == NULL ? 0 : $retorno;
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
		$sql = DmlSqlPlanoUsuario::SELECT . ' WHERE ' . DmlSqlPlanoUsuario::PLUS_ID . '=' . $id;
		$res = $conexao->query($sql);
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
		$res = $conexao->query(DmlSqlPlanoUsuario::SELECT . ' WHERE ' . DmlSqlPlanoUsuario::PLUS_ID . '=' . $dto->id );
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
		$retorno = new PlanoUsuarioDTO();
		$retorno->id = $resultset[DmlSqlPlanoUsuario::PLUS_ID];
		$retorno->idparent = $resultset[DmlSqlPlanoUsuario::PLUS_ID_PARENT];
		$retorno->usuarioid = $resultset[DmlSqlPlanoUsuario::USUA_ID];
		$retorno->planoid = $resultset[DmlSqlPlanoUsuario::PLAN_ID];
		$retorno->nome = $resultset[DmlSqlPlanoUsuario::PLUS_NM_PLANO];
		$retorno->permissao = $resultset[DmlSqlPlanoUsuario::PLUS_TX_PERMISSAO];
		$retorno->valor = $resultset[DmlSqlPlanoUsuario::PLUS_VL_PLANO];
		$retorno->valorMoeda = $resultset[DmlSqlPlanoUsuario::PLUS_VL_PLANO] == NULL ? Util::getMoeda(0.00) : Util::getMoeda((double) $resultset[DmlSqlPlanoUsuario::PLUS_VL_PLANO]);
		$retorno->status = $resultset[DmlSqlPlanoUsuario::PLUS_IN_STATUS];
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuario::PLUS_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuario::PLUS_DT_UPDATE]);
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}
}
