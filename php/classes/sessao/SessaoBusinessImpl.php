<?php

/**
 * 
 * SessaoBusinessImpl
 */

require_once '../interfaces/BusinessObject.php';
require_once '../daofactory/DAOFactory.php';
require_once '../usuarios/UsuarioDAO.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../dto/DTOPadrao.php';
require_once '../util/util.php';
require_once '../usuarioversao/UsuarioVersaoBusinessImpl.php';

class SessaoBusinessImpl implements SessaoBusiness
{
	
	function __construct()
	{
		# code...
	}

	public function deletar($daofactory, $dto)	{}
	public function atualizar($daofactory, $dto) {}
	public function listarTudo($daofactory)	{}
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	public function carregarPorToken($daofactory, $token)
	{
		$dao = $daofactory->getSessaoDAO($daofactory);
		$retorno = $dao->loadToken($token);

		if ($retorno->id == null || $retorno->status != ConstantesVariavel::STATUS_ATIVO){
			$retorno->msgcode = ConstantesMensagem::SESSAO_INVALIDA_DO_USUARIO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		} else if ($retorno->id != null) {
			// Retorno padrão
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

			$daousu = $daofactory->getUsuarioDAO($daofactory);
			$retorno->usuariodto = $daousu->loadPK($retorno->usuario);

			if($retorno->usuariodto->status == ConstantesVariavel::STATUS_BLOQUEADO){
				$retorno->msgcode = ConstantesMensagem::USUARIO_BLOQUEADO_ENVIAR_ZAP;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				return $retorno;
			}

			if( $retorno->forcelogin == ConstantesVariavel::STATUS_PERMITIDO){
				$retorno->msgcode = ConstantesMensagem::SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1 => VariavelCache::getInstance()->getVariavel(ConstantesVariavel::SYSINFO_APP)
				]);
			}
		} else {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	// Carrega um objeto
	public function carregarPorID($daofactory, $id)
	{
		$dao = $daofactory->getSessaoDAO($daofactory);
		return $dao->loadPK($id);

	}

	public function carregar($daofactory, $dto)
	{
		$dao = $daofactory->getSessaoDAO($daofactory);
		return $dao->load($dto);

	}

	public function inserir($daofactory, $dto)
	{
		// prepara uma sessão
		$sdto = new SessaoDTO();
		$sdto->usuario = $dto->id;
		$sdto->tokenid = $this->getToken($dto->email);
		$sdto->keep = ConstantesVariavel::STATUS_NEGADO;

		$dao = $daofactory->getSessaoDAO($daofactory);
		if($dao->insert($sdto)) {
			$sdto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$sdto->msgcodeString = MensagemCache::getInstance()->getMensagem($sdto->msgcode);
		} else {
			$sdto->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$sdto->msgcodeString = MensagemCache::getInstance()->getMensagem($sdto->msgcode);

		}
		return $sdto;
	}

	public function validarRegrasAutenticacaoFacebook($daofactory, $idfcbk, $nome, $email, $versao)
	{
		$sessaodto = "";

		// fluxo e retorno padrao
		$seguefluxo = true;
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// Busca DTO do usuario
		$ubi = new UsuarioBusinessImpl();
		$usuariodto = $ubi->carregarUsuarioPorLogin($daofactory, $email);
		//var_dump($usuariodto);

		// Usuário não existe e será incluído automaticamente
		if(is_null($usuariodto) || is_null($usuariodto->id)) {
			$retorno->msgcode = ConstantesMensagem::NOVO_USUARIO_FACEBOOK_AUTENTICADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
			//$seguefluxo = false;
		}

		if ($seguefluxo) {
			if($usuariodto->email !== $email){
				$retorno->msgcode = ConstantesMensagem::EMAIL_FACEBOOK_DIFERENTE_CANIVETE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				return $retorno;
				//$seguefluxo = false;
			}
		}

		// Validar a versão que vem do dispositivo cliente
		$usvebo = new UsuarioVersaoBusinessImpl();
		$checkdto = $usvebo->verificarVersaoSistema($daofactory, $usuariodto->id, $versao);
		if($checkdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO &&
			$checkdto->msgcode != ConstantesMensagem::VERSAO_DESATUALIZADA
		){
			return $checkdto;
		}

		// ... registra sessao no bd
		if ($seguefluxo){
			$sbi = new SessaoBusinessImpl();
			$sessaodto = $sbi->inserir($daofactory, $usuariodto);
//var_dump($sessaodto)			;
			$sessaodto->usuariodto = $usuariodto;
			$sessaodto->urlControlador = $this->getUrlControladorAtivo();
			$sessaodto->tipousuario = $usuariodto->tipoConta;
			$sessaodto->msgcode = $retorno->msgcode;
			$sessaodto->msgcodeString = $retorno->msgcodeString;

		} else {
			$sessaodto = new SessaoDTO();
			$sessaodto->msgcode = $retorno->msgcode;
			$sessaodto->msgcodeString = $retorno->msgcodeString;
		}

//		var_dump($sessaodto);
		return $sessaodto;
	}

	public function validarRegrasAutenticacaoApp($daofactory, $usuario, $senha, $manterconectado, $versao)
	{
		$sessaodto = new SessaoDTO();

		// fluxo e retorno padrao
		$seguefluxo = true;
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// Busca DTO do usuario
		$ubi = new UsuarioBusinessImpl();
		$usuariodto = $ubi->carregarUsuarioPorLogin($daofactory, $usuario);

		if($usuariodto->id == NULL) {
			$retorno->msgcode = ConstantesMensagem::USUARIO_SENHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}

		// Verificar senha
		if ($seguefluxo) {
			if(!$this->validarSenha($usuariodto, $senha)){
				$retorno->msgcode = ConstantesMensagem::USUARIO_SENHA_INVALIDO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// Usuario ainda em estagio de confirmação do email
		if ($seguefluxo) {
			if($usuariodto->status == ConstantesVariavel::STATUS_PENDENTE){
				$retorno->msgcode = ConstantesMensagem::CONFIRMACAO_EMAIL_NOVA_CONTA_PENDENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// Validar a versão que vem do dispositivo cliente
		$usvebo = new UsuarioVersaoBusinessImpl();
		$checkdto = $usvebo->verificarVersaoSistema($daofactory, $usuariodto->id, $versao);
		if($checkdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO &&
			$checkdto->msgcode != ConstantesMensagem::VERSAO_DESATUALIZADA
		){
			return $checkdto;
		}

		// ... registra sessao no bd
		if ($seguefluxo){
			$sbi = new SessaoBusinessImpl();

			$sdto = new SessaoDTO();
			$sdto->usuario = $usuariodto->id;
			$sdto->tokenid = $this->getToken($usuariodto->email);
			$sdto->keep = ($manterconectado ? ConstantesVariavel::STATUS_PERMITIDO : ConstantesVariavel::STATUS_NEGADO);

			$dao = $daofactory->getSessaoDAO($daofactory);
			$ok = $dao->insert($sdto);

			if($ok){
				$sessaodto = new SessaoDTO();
				$sessaodto->usuario = $sdto->usuario;
				$sessaodto->usuariodto = $usuariodto;
				$sessaodto->usuariodto->pwd = NULL;
				$sessaodto->tokenid = $sdto->tokenid;
				$sessaodto->tipousuario = $usuariodto->tipoConta;
				$sessaodto->urlControlador = $this->getUrlControladorAtivo();
				$sessaodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$sessaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($sessaodto->msgcode);
			} else {
				$sessaodto = new SessaoDTO();
				$sessaodto->msgcode = ConstantesMensagem::ERRO_AO_REGISTRAR_MANTER_NOVA_SESSAO;
				$sessaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($sessaodto->msgcode);
			}
		} else {
			$sessaodto = new SessaoDTO();
			$sessaodto->msgcode = $retorno->msgcode;
			$sessaodto->msgcodeString = $retorno->msgcodeString;
		}

//		var_dump($sessaodto);
		return $sessaodto;
	}

	public function validarRegrasAutenticacao($daofactory, $usuario, $senha)
	{
		$sessaodto = "";

		// fluxo e retorno padrao
		$seguefluxo = true;
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// Busca DTO do usuario
		$ubi = new UsuarioBusinessImpl();
		$usuariodto = $ubi->carregarUsuarioPorLogin($daofactory, $usuario);
//		var_dump($usuariodto);

		if(is_null($usuariodto->id)) {
			$retorno->msgcode = ConstantesMensagem::USUARIO_SENHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$seguefluxo = false;
		}

		// Verificar senha
		if ($seguefluxo) {
			if(!$this->validarSenha($usuariodto, $senha)){
				$retorno->msgcode = ConstantesMensagem::USUARIO_SENHA_INVALIDO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// Usuario ainda em estagio de confirmação do email
		if ($seguefluxo) {
			if($usuariodto->status == ConstantesVariavel::STATUS_PENDENTE){
				$retorno->msgcode = ConstantesMensagem::CONFIRMACAO_EMAIL_NOVA_CONTA_PENDENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// ... registra sessao no bd
		if ($seguefluxo){
			//$sbi = new SessaoBusinessImpl();
			//$ok = $sbi->inserir($daofactory, $usuariodto);

			$sdto = new SessaoDTO();
			$sdto->usuario = $usuariodto->id;
			$sdto->tokenid = $this->getToken($usuariodto->email);
			$sdto->keep = ConstantesVariavel::STATUS_NEGADO;

			$dao = $daofactory->getSessaoDAO($daofactory);
			$ok = $dao->insert($sdto);

			if($ok){
				$sessaodto = new SessaoDTO();
				$sessaodto->usuario = $sdto->usuario;
				$sessaodto->usuariodto = $usuariodto;
				$sessaodto->tokenid = $sdto->tokenid;
				$sessaodto->tipousuario = $usuariodto->tipoConta;
				$sessaodto->urlControlador = $this->getUrlControladorAtivo();
				$sessaodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$sessaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($sessaodto->msgcode);
			} else {
				$sessaodto = new SessaoDTO();
				$sessaodto->msgcode = ConstantesMensagem::ERRO_AO_REGISTRAR_NOVA_SESSAO;
				$sessaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($sessaodto->msgcode);
			}
		} else {
			$sessaodto = new SessaoDTO();
			$sessaodto->msgcode = $retorno->msgcode;
			$sessaodto->msgcodeString = $retorno->msgcodeString;
		}

//		var_dump($sessaodto);
		return $sessaodto;
	}

	public function getUrlControladorAtivo()
	{
		$urldefault = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_DSV_CONTROLADOR);
		
		switch (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::AMBIENTE_ATIVO)) {
			case ConstantesVariavel::AMBIENTE_PRD:
				$urldefault = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_PRD_CONTROLADOR);
				break;
			
			case ConstantesVariavel::AMBIENTE_HMG:
				$urldefault = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_HMG_CONTROLADOR);
				break;
			
			default:
			$urldefault = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_DSV_CONTROLADOR);
				break;
		}
		return $urldefault;
	}

	public function validarSenha($usuario, $senha)
	{
		// retorno padrão é negado
		$retorno = false;

		// Aplica algoritimo sha1
		$pwdsha1 = sha1($senha);

		if ($pwdsha1 == $usuario->pwd) {
			$retorno = true;
		}

		// retorno
		return $retorno;
	}

	public function validarToken($daofactory, $token)
	{
		$retorno = false;

		$dao = $daofactory->getSessaoDAO($daofactory);
		$sessaodto = $dao->loadToken($token);
		if ($token == $sessaodto->tokenid)
		{
			$retorno = true;
		}

		return $retorno;
	}


	/**
	 * getToken() - cria um token sha1 com base em uma string + timestamp + codigo(128)
	 */
	private function getToken($mix) {
		// cria um token
		$dt = new DateTime();
		$str = $mix . $dt->getTimestamp() . Util::getCodigo(128);
		return sha1($str);
	}




}

?>