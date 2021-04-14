<?php

/**
 * MySqlUsuarioProjetosDAO - Implementação DAO para usuário x projetos
 */

require_once 'ProjetoDAO.php';
require_once 'ProjetoDTO.php';
require_once 'DmlSqlProjeto.php';

require_once '../daofactory/DmlSql.php';

class MySqlProjetoDAO implements ProjetoDAO
{
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto) 
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::DOUBLE_TYPE
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							, $dto->usuarioid
							, $dto->projeto 
							, $dto->email_contato
							, $dto->palavra_chave_exata 
							, $dto->headline 
							, $dto->plataforma 
							, $dto->nicho 
							, $dto->nome_produto
							, $dto->desc_produto
							, $dto->tipo_produto
							, $dto->preco_produto
							, $dto->hotlink_pv
							, $dto->hotlink_chkout
							, $dto->autoridade
							, $dto->breve_desc_autoridade
							, $dto->url_minisite
							, $dto->status );


		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function delete($dto) {	}

	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto
	*/
	public function loadPK($id)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* load() - Leitura da base de usuários
	* @param $dto - UsuarioDTO
	*/
	public function load($dto) 
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}

	public function listProjetosArray($idUsuario)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::WHERE_PROJETOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $idUsuario );
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			array_push($retorno, $this->getDTO($row));
		}
		return $retorno;
	}

	public function loadProjetoEspecifico($idUsuario, $idProjeto)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::WHERE_ESPECIFICO);
		$stmt->bind_param(	DmlSql::INTEGER_TYPE 
							.DmlSql::INTEGER_TYPE, $idUsuario, $idProjeto);
		$stmt->execute();

		/* transforma o resultado para objeto serializável */
		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));


	}


	public function update($dto) {	
		$retorno = false;

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjeto::WHERE_UPD_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::DOUBLE_TYPE
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							, $dto->usuarioid
							, $dto->projeto 
							, $dto->email_contato
							, $dto->palavra_chave_exata 
							, $dto->headline 
							, $dto->plataforma 
							, $dto->nicho 
							, $dto->nome_produto
							, $dto->desc_produto
							, $dto->tipo_produto
							, $dto->preco_produto
							, $dto->hotlink_pv
							, $dto->hotlink_chkout
							, $dto->autoridade
							, $dto->url_minisite
							, $dto->breve_desc_autoridade
							, $dto->id);

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
		$retorno = new ProjetoDTO();
		$retorno->id = $resultset[DmlSqlProjeto::PROJ_ID];
		$retorno->usuarioid = $resultset[DmlSqlProjeto::USUA_ID];
		$retorno->projeto = $resultset[DmlSqlProjeto::PROJ_NM_NOME];
		$retorno->email_contato = $resultset[DmlSqlProjeto::PROJ_TX_EMAIL];
		$retorno->palavra_chave_exata = $resultset[DmlSqlProjeto::PROJ_TX_PCHAVE];
		$retorno->headline = $resultset[DmlSqlProjeto::PROJ_TX_HEADLINE];
		$retorno->nicho = $resultset[DmlSqlProjeto::PROJ_NM_NICHO];
		$retorno->plataforma = $resultset[DmlSqlProjeto::PROJ_TX_PDIGITAL];
		$retorno->nome_produto = $resultset[DmlSqlProjeto::PROJ_NM_PROD];
		$retorno->desc_produto = $resultset[DmlSqlProjeto::PROJ_TX_DESC_PROD];
		$retorno->tipo_produto = $resultset[DmlSqlProjeto::PROJ_TX_TIPO_PROD];
		$retorno->preco_produto = $resultset[DmlSqlProjeto::PROJ_VL_PROD];
		$retorno->hotlink_pv = $resultset[DmlSqlProjeto::PROJ_TX_HOTLNK];
		$retorno->hotlink_chkout = $resultset[DmlSqlProjeto::PROJ_TX_CHKLNK];
		$retorno->autoridade = $resultset[DmlSqlProjeto::PROJ_NM_AUTORIDADE];
		$retorno->breve_desc_autoridade = $resultset[DmlSqlProjeto::PROJ_TX_BREVE_DESC];
		$retorno->url_minisite = $resultset[DmlSqlProjeto::PROJ_TX_URL_MINISITE];
		$retorno->status = $resultset[DmlSqlProjeto::PROJ_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlProjeto::PROJ_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjeto::PROJ_DT_UPDATE];

		return $retorno;
	}

}
?>