<?php

/**
 * MySqlUsuarioDAO - Implementação DAO para usuário
 */

require_once 'UsuarioDAO.php';
require_once 'UsuarioDTO.php';
require_once 'DmlSqlUsuario.php';
require_once 'DmlSqlProjeto.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlUsuarioDAO implements UsuarioDAO
{
	private $daofactory;
	
	public function update($dto)	{	}
	public function delete($dto)	{	}

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function updateLiberarContaUsuario($token)
	{
		var_dump($token);
		var_dump(DmlSqlUsuario::UPD_STATUS_CHAVE_ATIVACAO);
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$status = "A";
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::UPD_STATUS_CHAVE_ATIVACAO);
		$stmt->bind_param(DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE, 
							$status, 
							$token );
		$retorno = $stmt->execute();

		return $retorno;

	}

	public function insert($dto) 
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::INS);
		$stmt->bind_param(DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE, 
							$dto->email, 
							$dto->apelido, 
							$dto->pwd, 
							$dto->tipoConta, 
							$dto->codigoAtivacao );
		$retorno = $stmt->execute();

		return $retorno;

	}


	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto - UsuarioDTO
	*/
	public function loadPK($id)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $id );
		
		/* usando mysqli_fetch_all - padrao do meu sistema */
		$stmt->execute(); 

		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}

	/**
	* loadUsuarioPorCodigoAtivacao() - Leitura da base de usuários pelo token de ativação
	* @param $token - string
	*/
	public function loadUsuarioPorCodigoAtivacao($token)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::WHERE_TOKEN_ATIVACAO);
		$stmt->bind_param(DmlSql::STRING_TYPE, $token );
		$stmt->execute();

		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));

	}


	/**
	* loadUsuarioLogin() - Leitura da base de usuários por login do usuário (email)
	* @param $dto - UsuarioDTO
	*/
	public function loadUsuarioLogin($idUsuario)
	{
		//echo DmlSqlUsuario::WHERE_EMAIL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::WHERE_EMAIL);
		$stmt->bind_param(DmlSql::STRING_TYPE, $idUsuario );
		$stmt->execute();

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
		$stmt = $conexao->prepare(DmlSqlUsuario::WHERE_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE, $dto->id );
		$stmt->execute();

		$res = $stmt->get_result();
		return $this->getDTO($res->fetch_array(MYSQLI_ASSOC));
	}


	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new UsuarioDTO();
		$retorno->id = $resultset[DmlSqlUsuario::USUA_ID];
		$retorno->email = $resultset[DmlSqlUsuario::USUA_TX_EMAIL];
		$retorno->apelido = $resultset[DmlSqlUsuario::USUA_TX_NOME];
		$retorno->tipoConta = $resultset[DmlSqlUsuario::USUA_IN_TIPO_CONTA];
		$retorno->codigoAtivacao = $resultset[DmlSqlUsuario::USUA_TX_CODIGO_ATIVACAO];
		$retorno->dataAtivacao = $resultset[DmlSqlUsuario::USUA_DT_CODIGO_ATIVACAO];
		$retorno->pwd = $resultset[DmlSqlUsuario::USUA_TX_SENHA];
		$retorno->status = $resultset[DmlSqlUsuario::USUA_IN_STATUS];
		$retorno->dataCadastro = $resultset[DmlSqlUsuario::USUA_DT_CADASTRO];
		$retorno->dataAtualizacao = $resultset[DmlSqlUsuario::USUA_DT_UPDATE];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>