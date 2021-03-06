<?php

/**
 * MySqlKinghostProjetoBonusDAO - Implementação DAO para projetos x bonus
 */

require_once 'ProjetoBonusDAO.php';
require_once 'BonusDTO.php';
require_once 'DmlSqlProjetoBonus.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostProjetoBonusDAO implements ProjetoBonusDAO
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
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoBonus::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE
							.DmlSql::STRING_TYPE, $dto->projetoid, $dto->desc );
		$retorno = $stmt->execute();

		return $retorno;
	}

	public function delete($dto) 
	{	
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlProjetoBonus::DEL_WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto );
		$retorno = $stmt->execute();

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
		$res = $conexao->query(DmlSqlProjetoBonus::SELECT . ' WHERE ' . DmlSqlProjetoBonus::PRBO_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* load() - Leitura da base de usuários
	* @param $dto - UsuarioDTO
	*/
	public function load($dto) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoBonus::SELECT . ' WHERE ' . DmlSqlProjetoBonus::PRBO_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function listBonus($idProjeto)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlProjetoBonus::SELECT . ' WHERE `' . DmlSqlProjetoBonus::PROJ_ID . '` =' . $idProjeto);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function update($dto) {	}

	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new BonusDTO();
		$retorno->id = $resultset[DmlSqlProjetoBonus::PRBO_ID];
		$retorno->projetoid = $resultset[DmlSqlProjetoBonus::PROJ_ID];
		$retorno->desc = $resultset[DmlSqlProjetoBonus::PRBO_TX_BONUS];
		$retorno->dataCadastro = $resultset[DmlSqlProjetoBonus::PRBO_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlProjetoBonus::PRBO_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		

		return $retorno;
	}

}
?>
