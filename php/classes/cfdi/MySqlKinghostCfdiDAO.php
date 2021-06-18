<?php

/**
 * MySqlKinghostCfdiDAO - Implementação DAO
 */

require_once 'cfdiDTO.php';
require_once 'cfdiDAO.php';
require_once 'DmlSqlCfdi.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCfdiDAO implements cfdiDAO
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
		$res = $conexao->query( $sql . ' LIMIT ' . $final . ',' . $qtde );
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function loadCarimbo($carimbo)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCfdi::SQL_SELECT . ' WHERE ' . DmlSqlCfdi::COLS[3] . "= '" . $carimbo . "'" );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function loadPK($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCfdi::SQL_SELECT . ' WHERE ' . DmlSqlCfdi::COLS[0] . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}
	public function updateUsuarioGeradorQRCode($carimbo, $idusuarioGerador)
	{	

		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCfdi::SQL_UPD_USUA_ID_GERADOR);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							,$idusuarioGerador
							,$carimbo);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateStatus($id, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCfdi::SQL_UPD_STATUS);
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
		$stmt = $conexao->prepare(DmlSqlCfdi::SQL_INS);
		$stmt->bind_param(	DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::DOUBLE_TYPE
							. DmlSql::INTEGER_TYPE
							,$dto->id_campanha
							,$dto->id_fiel
							,$dto->qrcode 
							,$dto->modo
							,$dto->status
							,$dto->valorTicketMedioCarimbo
							,$dto->idUsuarioAutorizador );
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
		$retorno = new CfdiDTO();
		$retorno->id = $resultset[DmlSqlCfdi::COLS[0]];
		$retorno->id_campanha = $resultset[DmlSqlCfdi::COLS[1]];
		$retorno->id_fiel = $resultset[DmlSqlCfdi::COLS[2]];
		$retorno->qrcode = $resultset[DmlSqlCfdi::COLS[3]];
		$retorno->modo = $resultset[DmlSqlCfdi::COLS[4]];
		$retorno->valorTicketMedioCarimbo = (double) $resultset[DmlSqlCfdi::COLS[8]];
		$retorno->idUsuarioAutorizador = (int) $resultset[DmlSqlCfdi::COLS[9]];
		$retorno->status = $resultset[DmlSqlCfdi::COLS[5]];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCfdi::COLS[6]]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCfdi::COLS[7]]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>
