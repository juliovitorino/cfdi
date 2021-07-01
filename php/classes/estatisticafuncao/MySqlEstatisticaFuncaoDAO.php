<?php

/**
 * MySqlHeadlineHistoricoDAO - Implementação DAO para headline historico
 */

require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoDAO.php';
require_once 'DmlSqlEstatisticaFuncao.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlEstatisticaFuncaoDAO implements EstatisticaFuncaoDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto){ }
	public function delete($dto) {	}
	public function load($dto) 	{	}

	public function loadPK($id)
	{	

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}


	public function insert($dto) 
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->usuarioid
							,$dto->projetoid
							,$dto->ano
							,$dto->mes
							,$dto->dia
							,$dto->tipo );


		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function loadUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{	

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::WHERE_UIX);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$ano
							,$mes
							,$dia
							,$tipo
							,$usuarioid
							,$projetoid);
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}

	public function updateQtdePK($id)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$ano
							,$mes
							,$dia
							,$tipo
							,$usuarioid
							,$projetoid);

		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}




/*
	public function listHeadlinesPorSessao($sessaoid)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::WHERE_SESSAO . ' ORDER BY `HEHI_ID` DESC');
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $sessaoid );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */ /*
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			array_push($retorno, $this->getDTO($row));
		}
		return $retorno;
	}
*/
	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new EstatisticaFuncaoDTO();
		$retorno->id = $resultset[DmlSqlEstatisticaFuncao::ESFU_ID];
		$retorno->usuarioid = $resultset[DmlSqlEstatisticaFuncao::USUA_ID];
		$retorno->projetoid = $resultset[DmlSqlEstatisticaFuncao::PROJ_ID];
		$retorno->ano = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_ANO];
		$retorno->mes = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_MES];
		$retorno->dia = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_DIA];
		$retorno->tipo = $resultset[DmlSqlEstatisticaFuncao::ESFU_IN_TIPO];
		$retorno->qtde = $resultset[DmlSqlEstatisticaFuncao::ESFU_QT_FUNCAO];
		$retorno->dataCadastro = $resultset[DmlSqlEstatisticaFuncao::ESFU_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlEstatisticaFuncao::ESFU_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				

		return $retorno;
	}

}
?>
