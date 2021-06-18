<?php

/**
 * JsonUsuarioDAO - Implementação DAO para usuário
 */

require_once 'UsuarioDAO.php';
require_once 'TemplateLoader.php';
require_once 'UsuarioDTO.php';
require_once '../../mensagem/ConstantesMensagem.php';
require_once '../../mensagem/MensagemCache.php';

class JsonUsuarioDAO implements UsuarioDAO
{
	const HOME = 'usuario-dados.json';
	private $daofactory;
	
	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function insert($dto) 
	{

	}

	public function delete($dto)
	{

	}

	/**
	* load() - Leitura da base de usuários
	*/
	public function load($dto) 
	{
		$gc = GlobalStartup::getInstance();
		$t = new TemplateLoader(getcwd().$gc->pathjson.JsonUsuarioDAO::HOME);

		return $this->getDTO(json_decode($t->getConteudo(),true));

	}

	public function update($dto)
	{

	}


	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new UsuarioDTO();
		$retorno->id = $resultset['id'];
		$retorno->email = $resultset['email'];
		$retorno->pwd =  $resultset['pwd'];
		$retorno->apelido =  $resultset['apelido'];
		$retorno->tipoConta =  $resultset['tipo_conta'];
		$retorno->status = $resultset['status'];
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// falta fazer o loop no array de projetos
		foreach ($resultset['projetos'] as $item => $value) {
			array_push($retorno->lst_projetos, $value);
		}

		return $retorno;


	}
}
?>