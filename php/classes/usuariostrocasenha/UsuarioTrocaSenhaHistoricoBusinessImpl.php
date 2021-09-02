<?php

/**
 * 
 * UsuarioTrocaSenhaHistoricoBusinessImpl
 */

require_once 'UsuarioTrocaSenhaHistoricoBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../util/util.php';
require_once '../email/EmailDTO.php';
require_once '../email/EmailTemplateHub.php';
require_once '../email/Email.php';
require_once '../email/EmailSolucionador.php';
require_once '../variavel/VariavelCache.php';
require_once '../util/ambiente.php';

class UsuarioTrocaSenhaHistoricoBusinessImpl implements UsuarioTrocaSenhaHistoricoBusiness
{
	
	function __construct()
	{
		# code...
	}

	public function deletar($daofactory, $dto)	{}
	public function atualizar($daofactory, $dto) {}
	public function listarTudo($daofactory)	{}
	public function listarPagina($daofactory, $pag, $qtde)	{	}
	

	public function inserir($daofactory, $dto)
	{	
		$dao = $daofactory->getUsuarioTrocaSenhaHistoricoDAO($daofactory);
		$ok = $dao->insert($dto);
		$retorno = new DTOPadrao();
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}

	public function trocarSenhar($daofactory, $usuarioid, $pwd1, $pwd2, $token)
	{
		// prepara o retorno padrao
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		$seguefluxo = true;

		// verifica se pwd1 == pwd2
		if ($seguefluxo) {
			if ($pwd1 !== $pwd2 )
			{
				$retorno->msgcode = ConstantesMensagem::SENHAS_DIFERENTES;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// verifica se token existe para este usuario
		if ($seguefluxo){
			$dao = $daofactory->getUsuarioTrocaSenhaHistoricoDAO($daofactory);
			$utshdto = $dao->loadUsuarioTrocaSenhaHistoricoPorToken($token);
	
			// verifica se o token esta ativo
			if ($token !== $utshdto->token ){
				$retorno->msgcode = ConstantesMensagem::TOKEN_INVALIDO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}

			// verifica se o token esta ativo
			if ($utshdto->status !== ConstantesVariavel::STATUS_ATIVO){
				$retorno->msgcode = ConstantesMensagem::TOKEN_INVALIDO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}
		}

		// Verifica se a conta do usuario está ativa
		if ($seguefluxo){
			$daousua = $daofactory->getUsuarioDAO($daofactory);
			$udto = $daousua->loadPK($utshdto->usuarioid);

			if ($udto->status !== ConstantesVariavel::STATUS_ATIVO){
				$retorno->msgcode = ConstantesMensagem::STATUS_CONTA_USUARIO_COM_PROBLEMAS;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[ConstantesMensagem::MSGTAG_NOME => $udto->apelido]);
				$seguefluxo = false;
			}
		}

		if ($seguefluxo){
			// efetua troca de senha no perfil do usuario
			$daousua->updateNovaSenha($udto->id, sha1($pwd1));

			// finaliza utilizacao do token
			$dao->updateTokenStatus($utshdto->id, ConstantesVariavel::STATUS_FINALIZADO);

			// elimina tokens na conta deste usuário que ficaram pendentes
			$dao->updateUsuaIDTrocaStatus($udto->id, ConstantesVariavel::STATUS_ATIVO, ConstantesVariavel::STATUS_BLOQUEADO);

		}

		// retorna resultado do processo
		return $retorno;
	}


	public function esquecerSenha($daofactory, $email)
	{	
		// localiza o registro do usuario por email
		$dao = $daofactory->getUsuarioDAO($daofactory);
		$usuariodto = $dao->loadUsuarioLogin($email);
		
		if (!is_null($usuariodto->id)) 
		{
			// Incluir registro no historico de solicitacao e aguardar ação do usuario
			$dtoutsh = new UsuarioTrocaSenhaHistoricoDTO();
			$dtoutsh->usuarioid = $usuariodto->id;
			$dtoutsh->token = util::getCodigo(256);
			$daoutsh = $daofactory->getUsuarioTrocaSenhaHistoricoDAO($daofactory);
			$ok = $daoutsh->insert($dtoutsh);

			// obtem o link de troca senha com codigo de seguranca
			$homehtml = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_URL_HTML_CANIVETE);
			$url = Ambiente::getUrlAmbienteAtivo();

			$linktrocasenha = util::getTrocaConteudoParametrizada(
								VariavelCache::getInstance()->getVariavel(ConstantesVariavel::LINK_TROCA_SENHA),
								[
									ConstantesMensagem::MSGTAG_TOKEN_TROCA_SENHA => $dtoutsh->token,
									ConstantesMensagem::MSGTAG_USUARIO_ID => $dtoutsh->usuarioid,
									ConstantesMensagem::MSGTAG_HOME_URL_HTML_CANIVETE => $homehtml,
									ConstantesMensagem::MSGTAG_URL_AMBIENTE_ATIVO => $url

								]);

			// envia email de segurança com o link para a página de troca de senha
			$emaildto = new EmailDTO();
			$emaildto->destinatario = $usuariodto->apelido;
			$emaildto->emaildestinatario = $email;
			$emaildto->assunto =  MensagemCache::getInstance()->getMensagem(ConstantesMensagem::ASSUNTO_TROCA_DE_SENNHA);
			$emaildto->template = getcwd() 
						. VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_TEMPLATES_EMAIL)
						. EmailTemplateHub::TROCA_SENHA_CANIVETE;
			$emaildto->lsttags = 	[
					ConstantesMensagem::MSGTAG_NOME => $usuariodto->apelido,
					ConstantesMensagem::MSTAG_LINK_TROCA_SENHA => $linktrocasenha
					];

			$emailEntregador = new Email(new EmailSolucionador($emaildto));
			$emailEntregador->enviar();

			// Colocar uma notificação para o ADMIN
			// --> colocar notificação
		}

		// Emite a mensagem de qualquer
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::EMAIL_INSTRUCAO_TROCA_SENHA_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
				[
					ConstantesMensagem::MSGTAG_EMAIL => $email
				]);
		return $retorno;
	}

	// Carrega um objeto
	public function carregarPorID($daofactory, $id)
	{	
		$dao = $daofactory->getUsuarioTrocaSenhaHistoricoDAO($daofactory);
		$retorno = $dao->loadPK($id);
		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}

	public function carregar($daofactory, $dto)
	{
		$dao = $daofactory->getUsuarioTrocaSenhaHistoricoDAO($daofactory);
		$retorno = $dao->load($dto);
		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}

}

?>