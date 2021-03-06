<?php

/**
 * MySqlKinghostPlanoUsuarioFaturaDAO - Implementação DAO
 */

require_once 'PlanoUsuarioFaturaDAO.php';
require_once 'DmlSqlPlanoUsuarioFatura.php';
require_once 'PlanoUsuarioFaturaDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostPlanoUsuarioFaturaDAO implements PlanoUsuarioFaturaDAO
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
	
	public function loadPlanoUsuarioFaturaMaisRecente($plusid) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlPlanoUsuarioFatura::SELECT_MAX_PLUF_ID 
											. ' WHERE ' . DmlSqlPlanoUsuarioFatura::PLUS_ID . '=' . $plusid );

											//. ' AND ' . DmlSqlPlanoUsuarioFatura::PLUF_IN_STATUS . '=' . "'". $status ."'" );

		if ($res){
			$row = $res->fetch_assoc();
			foreach ($row as $key => $value) {
				$retorno = $value;
			}
		} else {
			$retorno = -1;
		}
		return $retorno;
	}

	
	public function loadPlanoUsuarioFaturaPorStatus($usuarioid, $status) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlPlanoUsuarioFatura::SELECT_MAX_PLUF_ID 
											. ' WHERE ' . DmlSqlPlanoUsuarioFatura::PLUS_ID . '=' . $usuarioid 
											. ' AND ' . DmlSqlPlanoUsuarioFatura::PLUF_IN_STATUS . '=' . "'". $status ."'" );
		if ($res){
			$row = $res->fetch_assoc();
			foreach ($row as $key => $value) {
				$retorno = $value;
			}
		} else {
			$retorno = -1;
		}
		return $retorno;
	}

	public function updateStatusPlanoUsuarioFaturaPorId($plufid, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlPlanoUsuarioFatura::UPD_PK_APROVAR_PAGAMENTO);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							, $status
							, $plufid );

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
		$stmt = $conexao->prepare(DmlSqlPlanoUsuarioFatura::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::DOUBLE_TYPE 
							. DmlSql::DOUBLE_TYPE 
							. DmlSql::STRING_TYPE 
							, $dto->planousuarioid
							, $dto->valorfatura 
							, $dto->valordesconto
							, $dto->dataVencimento);
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
		$res = $conexao->query(DmlSqlPlanoUsuarioFatura::SELECT . ' WHERE ' . DmlSqlPlanoUsuarioFatura::PLUF_ID . '=' . $id );
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
		$res = $conexao->query(DmlSqlPlanoUsuarioFatura::SELECT . ' WHERE ' . DmlSqlPlanoUsuarioFatura::PLUF_ID . '=' . $dto->id );
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
		$retorno = new PlanoUsuarioFaturaDTO();
		$retorno->id = $resultset[DmlSqlPlanoUsuarioFatura::PLUF_ID];
		$retorno->idparent = $resultset[DmlSqlPlanoUsuarioFatura::PLUF_ID_PARENT];
		$retorno->planousuarioid = $resultset[DmlSqlPlanoUsuarioFatura::PLUS_ID];
		$retorno->valorfatura = (double) $resultset[DmlSqlPlanoUsuarioFatura::PLUF_VL_FATURA];
		$retorno->valordesconto = (double) $resultset[DmlSqlPlanoUsuarioFatura::PLUF_VL_DESCONTO];
		$retorno->dataVencimento = $resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_VENCIMENTO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_VENCIMENTO]);
		$retorno->dataPagamento = $resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_PGTO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_PGTO]);
		$retorno->status = $resultset[DmlSqlPlanoUsuarioFatura::PLUF_IN_STATUS];
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoUsuarioFatura::PLUF_DT_UPDATE]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}
}
