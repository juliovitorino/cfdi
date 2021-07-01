<?php

/**
 * MySqlSessaoDAO - Implementação DAO para usuário
 */

require_once 'VariavelDAO.php';
require_once 'DmlSqlVariavel.php';
require_once 'VariavelDTO.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlVariavelDAO implements VariavelDAO
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
		$stmt = $conexao->prepare(DmlSqlVariavel::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* loadCodigoVariavel() - Leitura da base de usuários por PK
	* @param $dto - SessaoDTO
	*/
	public function loadCodigoVariavel($msgcodigo)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlVariavel::WHERE_UIX);
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
		$stmt = $conexao->prepare(DmlSqlVariavel::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* listVariavelStatus() - listagem de registros com status ativos
	* @param $status
	*/
	public function listVariavelStatus($status)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlVariavel::WHERE_STATUS);
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
		$retorno = new VariavelDTO();
		$retorno->id = $resultset[DmlSqlVariavel::VARI_ID];
		$retorno->variavel = $resultset[DmlSqlVariavel::VARI_NM_VARIAVEL];
		$retorno->descricao = $resultset[DmlSqlVariavel::VARI_TX_DESCRICAO];
		$retorno->conteudo = $resultset[DmlSqlVariavel::VARI_TX_VALOR_CONTEUDO];
		$retorno->status = $resultset[DmlSqlVariavel::VARI_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlVariavel::VARI_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlVariavel::VARI_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}

