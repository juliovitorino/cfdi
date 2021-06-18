<?php

/**
 * MySqlKinghostTraceDAO - Implementação DAO
 */

require_once 'traceDTO.php';
require_once 'traceDAO.php';
require_once 'DmlSqlTrace.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostTraceDAO implements TraceDAO
{
	private $daofactory;

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto){ }
	public function delete($dto) {	}
	public function load($dto) 	{	}
	public function listAll() 	{	}

	public function listPagina($sql, $pag, $qtde)
	{
		$retorno = array();

		$final = $pag * $qtde - $qtde;

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql . ' LIMIT ' . $final . ',' . $qtde );
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function loadPK($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlTrace::SQL_SELECT . ' WHERE ' . DmlSqlTrace::COLS[0] . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function updateStatus($id, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlTrace::SQL_UPD_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$status
							,$id);
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
		$stmt = $conexao->prepare(DmlSqlTrace::SQL_INS);
		$stmt->bind_param(	DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->tipo
							,$dto->descricao);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new CampanhaDTO();
		$retorno->id = $resultset[DmlSqlTrace::COLS[0]];
		$retorno->tipo = $resultset[DmlSqlTrace::COLS[1]];
		$retorno->descricao = $resultset[DmlSqlTrace::COLS[2]];
		$retorno->status = $resultset[DmlSqlTrace::COLS[3]];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlTrace::COLS[4]]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlTrace::COLS[5]]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>
