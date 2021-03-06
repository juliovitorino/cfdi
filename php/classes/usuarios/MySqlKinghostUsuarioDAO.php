<?php

/**
 * MySqlKinghostUsuarioDAO - Implementação DAO para usuário
 */

require_once 'UsuarioDAO.php';
require_once 'UsuarioDTO.php';
require_once 'DmlSqlUsuario.php';
require_once 'DmlSqlProjeto.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostUsuarioDAO implements UsuarioDAO
{
	private $daofactory;
	
	public function update($dto)	{	}
	public function delete($dto)	{	}
	public function listAll() 	{	}
	public function listPagina($sql, $pag, $qtde)	{	}

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function updateFotoPerfil($usuaid, $urlfoto)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::UPD_FOTO_PERFIL_POR_PK);
		$stmt->bind_param(DmlSql::STRING_TYPE
							. DmlSql::INTEGER_TYPE, 
							$urlfoto, 
							$usuaid );
		$retorno = $stmt->execute();

		return $retorno;

	}


	public function updateNovaSenha($usuarioid, $pwd)
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::UPD_SENHA_POR_PK);
		$stmt->bind_param(DmlSql::STRING_TYPE
							. DmlSql::INTEGER_TYPE, 
							$pwd, 
							$usuarioid );
		$retorno = $stmt->execute();

		return $retorno;
	}

	public function updateLiberarContaUsuario($token)
	{
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

	public function insertUsuarioFacebook($dto) 
	{
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuario::INS_FCBK);
		$stmt->bind_param( DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE
							. DmlSql::STRING_TYPE, 
							$dto->iduserfacebook, 
							$dto->urlfoto,
							$dto->email, 
							$dto->apelido, 
							$dto->pwd, 
							$dto->status,
							$dto->tipoConta, 
							$dto->codigoAtivacao );
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
							$dto->codigoAtivacao);
		$retorno = $stmt->execute();

		return $retorno;

	}

	/**
	* loadIDFacebook() - Leitura da base de usuários por ID do facebook
	* @param $dto - UsuarioDTO
	*/
	public function loadIDFacebook($id)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuario::SELECT . ' WHERE ' . DmlSqlUsuario::COLS[10] . "= '" . $id . "'");
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* loadPK() - Leitura da base de usuários por PK
	* @param $dto - UsuarioDTO
	*/
	public function loadPK($id)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuario::SELECT . ' WHERE ' . DmlSqlUsuario::COLS[0] . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	/**
	* loadUsuarioPorCodigoAtivacao() - Leitura da base de usuários pelo token de ativação
	* @param $token - string
	*/
	public function loadUsuarioPorCodigoAtivacao($token)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuario::SELECT . ' WHERE ' . DmlSqlUsuario::COLS[8] . '=' . "'" . $token . "'" );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

	/**
	* loadUsuarioLogin() - Leitura da base de usuários por login do usuário (email)
	* @param $dto - UsuarioDTO
	*/
	public function loadUsuarioLogin($idUsuario)
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlUsuario::SELECT . ' WHERE ' . DmlSqlUsuario::COLS[1] . '=' . "'" . $idUsuario . "'" );
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
		$res = $conexao->query(DmlSqlUsuario::SELECT . ' WHERE ' . DmlSqlUsuario::COLS[0] . '=' . $dto->id );
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
		$retorno = new UsuarioDTO();
		$retorno->id = $resultset[DmlSqlUsuario::COLS[0]];
		$retorno->iduserfacebook = $resultset[DmlSqlUsuario::COLS[10]];
		$retorno->urlfoto = $resultset[DmlSqlUsuario::COLS[11]];
		$retorno->email = $resultset[DmlSqlUsuario::COLS[1]];
		$retorno->apelido = $resultset[DmlSqlUsuario::COLS[2]];
		$retorno->tipoConta = $resultset[DmlSqlUsuario::COLS[7]];
		$retorno->codigoAtivacao = $resultset[DmlSqlUsuario::COLS[8]];
		$retorno->dataAtivacao = $resultset[DmlSqlUsuario::COLS[9]];
		$retorno->pwd = $resultset[DmlSqlUsuario::COLS[3]];
		$retorno->status = $resultset[DmlSqlUsuario::COLS[4]];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuario::COLS[5]]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuario::COLS[6]]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>
