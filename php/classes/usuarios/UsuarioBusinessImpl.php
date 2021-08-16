<?php

/**
 * 
 * UsuariosBusiness
 */

require_once 'UsuarioDAO.php';
require_once 'UsuarioBusiness.php';
require_once 'ProjetoTecnicaDTO.php';
require_once 'ProjetoItemDTO.php';
require_once 'ProjetoDorDTO.php';
require_once 'ProjetoBonusDTO.php';
require_once 'ProjetoBeneficioDTO.php';
require_once 'ProjetoDetalheDTO.php';

require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';
require_once '../usuariocashback/UsuarioCashbackDTO.php';

require_once '../usuariosplanos/PlanoUsuarioBusinessImpl.php';
require_once '../usuariosplanosfatura/PlanoUsuarioFaturaBusinessImpl.php';

require_once '../dto/DTOPadrao.php';

require_once '../email/EmailDTO.php';
require_once '../email/Email.php';
require_once '../email/EmailTemplateHub.php';
require_once '../email/EmailSolucionador.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/VariavelHelper.php';

require_once '../tags/TagHub.php';

require_once '../util/util.php';
require_once '../util/ambiente.php';

require_once '../daofactory/DAOFactory.php';

require_once '../estatisticafuncao/EstatisticaFuncaoDTO.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../estatisticafuncao/EstatisticaFuncaoHelper.php';

class UsuarioBusinessImpl implements UsuarioBusiness
{
	
	function __construct()
	{
		# code...
	}

	public function deletar($daofactory, $dto) {}
	public function atualizar($daofactory, $dto) {}
	public function listarTudo($daofactory) {}
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	/**
	 * atualizarFotoPerfilRedeSocial() - Atualiza Foto do Perfil do Usuário com a da Rede Social (Facebook/Google)
	 * @param $daofactory
	 * @param $email
	 * @param $urlfoto
	 * @return $status
	 */
	public function atualizarFotoPerfilRedeSocial($daofactory, $email, $urlfoto)
	{
		$usuadto = $this->carregarUsuarioPorLogin($daofactory, $email);
		if ($urlfoto != $usuadto->urlfoto){
			// obtem interface e insere o registro
			$dao = $daofactory->getUsuarioDAO($daofactory);
			$dto = $dao->updateFotoPerfil($usuadto->id, $urlfoto);
		}
	}


	/**
	 * habilitarContaPorEmail() - Habilitar uma conta nova por hash de 128
	 * @param $daofactory
	 * @param $token
	 * @return $status
	 */
	public function habilitarContaPorEmail($daofactory, $token)
	{
		$status = new DTOPadrao();
		// obtem interface e insere o registro
		$dao = $daofactory->getUsuarioDAO($daofactory);
		$dto = $dao->loadUsuarioPorCodigoAtivacao($token);

		// Verifica se o status já está ativo
		if ($dto->status == ConstantesVariavel::STATUS_ATIVO) {

			$status->msgcode = ConstantesMensagem::CONTA_JA_ATIVADA;
			$status->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($status->msgcode, 
																	[ConstantesMensagem::MSGTAG_DATA_ATIVACAO => $dto->dataAtivacao]);

		} else if ($dto->status == ConstantesVariavel::STATUS_PENDENTE) 	{
			$ok = $dao->updateLiberarContaUsuario($token);
			if($ok){
				$status->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$status->msgcodeString = MensagemCache::getInstance()->getMensagem($status->msgcode);
			} else {
				$status->msgcode = ConstantesMensagem::ERRO_HABILITAR_CONTA_POR_EMAIL;
				$status->msgcodeString = MensagemCache::getInstance()->getMensagem($status->msgcode);

			}
		}

		return $status;
	}

	/**
	* inserirNovaConta() - Inserir a nova conta, enviar email, criar plano e ficha financeira
	* @param daofactory
	* @param dto
	* @param integer
	* @return dtopadrao
	*/
	public function inserirNovaConta($daofactory, $dto, $planoid)
	{
		$retorno = new DTOPadrao();
		$seguefluxo = true;

		// Verifica se o email já está em uso
		$dtotemp = $this->carregarUsuarioPorLogin($daofactory, $dto->email);
		if (! is_null($dtotemp->id)){
			$retorno->msgcode = ConstantesMensagem::EMAIL_EM_USO_POR_OUTRO_USUARIO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$seguefluxo = false;
		}

		if ($seguefluxo) {
			// Fase 1 - Inserir o registro da nova conta
			$ok = $this->inserir($daofactory, $dto);

			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = ConstantesMensagem::ERRO_AO_INSERIR_NOVA_CONTA;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [ '*=nome=*' => $dto->nome ]);

				$seguefluxo = false;
			} else {
				// Repopula do DTO do usuário buscando pelo e-mail
				$dto = $this->carregarUsuarioPorLogin($daofactory, $dto->email);
			}		
		}

		// Fase 2 - Inserir o plano do usuario
		if ($seguefluxo) {

			$ok = $this->inserirNovoPlanoUsuario($daofactory, $dto, $planoid);
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}

		// Fase 3 - Inserir o plano no histórico financeiro
		if ($seguefluxo) {

			$ok = $this->inserirNovoPlanoFinanceiroUsuario($daofactory, $dto, $planoid);
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}

		// Fase 4 - ativar o plano e liquidar fatura do financeiro
		if ($seguefluxo) {

			$ok = $this->ativarPlanoFinanceiroUsuarioGratuito($daofactory, $dto, $planoid);
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}

		// Fase 5 - Insere um registro no Usuario Cashback para acelerar processo
		if ($seguefluxo) {
			$dtousu = $this->carregarUsuarioPorLogin($daofactory, $dto->email);

			$ucdto = new UsuarioCashbackDTO();
			$ucdto->id_usuario = $dtousu->id;
			$ucdto->vlMinimoResgate = (double) VariavelHelper::getVariavel(ConstantesVariavel::USUARIO_CASHBASCK_PADRAO_RESGATE);
			$ucdto->percentual = (double) VariavelHelper::getVariavel(ConstantesVariavel::USUARIO_CASHBASCK_PADRAO_PERCENTUAL);
			$ucdto->obs = (double) VariavelHelper::getVariavel(ConstantesVariavel::USUARIO_CASHBASCK_PADRAO_OBS);

			$uscabo = new UsuarioCashbackBusinessImpl(); 
			$ok = $uscabo->inserir($daofactory, $ucdto);
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}


		// Fase 6 - Envia email?
		if ($seguefluxo) {

			$ok = $this->enviarEmailNovaConta($daofactory, $dto);
			if (
				($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) ||
				($ok->msgcode == ConstantesMensagem::EMAIL_CHAVE_ATIVACAO_DESLIGADA)
			 ) {
				$seguefluxo = true;
			} else {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode );
				$seguefluxo = false;

			}

		}
		// Prepara objeto de retorno
		if ($seguefluxo){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		// Retorna resultado da operação
		return $retorno;

	}


	/**
	* inserirNovaContaFacebook() - Inserir a nova conta com autenticação via facebook
	* @param daofactory
	* @param dto
	* @param integer
	* @return dtopadrao
	*/
	public function inserirNovaContaFacebook($daofactory, $dto)
	{

		$retorno = new DTOPadrao();
		$seguefluxo = true;

		// Verifica se o email já está em uso
		$dtotemp = $this->carregarUsuarioPorLogin($daofactory, $dto->email);

		if (! is_null($dtotemp->id)){
			$retorno->msgcode = ConstantesMensagem::EMAIL_EM_USO_POR_OUTRO_USUARIO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$seguefluxo = false;
		}

		if ($seguefluxo) {
			// Fase 1 - Inserir o registro da nova conta
			$ok = $this->inserirUsuarioFacebook($daofactory, $dto);
	
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = ConstantesMensagem::ERRO_AO_INSERIR_NOVA_CONTA;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [ '*=nome=*' => $dto->nome ]);
				return $retorno;	
				//$seguefluxo = false;
			}
			// Repopula do DTO do usuário buscando pelo e-mail
			$dto = $this->carregarUsuarioPorLogin($daofactory, $dto->email);
		}

		// Fase 2 - Inserir o plano do usuario
		if ($seguefluxo) {

			$ok = $this->inserirNovoPlanoUsuario($daofactory, 
				$dto, 
				VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				return $retorno;
				//$seguefluxo = false;
			}
		}
		
		// Fase 3 - Inserir o plano no histórico financeiro
		if ($seguefluxo) {

			$ok = $this->inserirNovoPlanoFinanceiroUsuario($daofactory, 
				$dto, 
				VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}

		// Fase 4 - ativar o plano e liquidar fatura do financeiro
		if ($seguefluxo) {
			$ok = $this->ativarPlanoFinanceiroUsuarioGratuito($daofactory, 
				$dto, 
				VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO));
			if ($ok->msgcode !== ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$retorno->msgcode = $ok->msgcode;
				$retorno->msgcodeString = $ok->msgcodeString;
				$seguefluxo = false;
			}
		}

		// Envia uma notificação ao ADMIN se chave estiver ligada
		if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
			$usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
			$msg =  MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::NOTIFICACAO_NOVO_USUARIO, [
				ConstantesVariavel::P1 => $dto->apelido,
			]);
			UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, "notify-03.png");
		}

		// Verifica a chave de remuneração de novo usuário na plataforma Junta10

		if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO) == ConstantesVariavel::ATIVADO)
		{
			$vllancar = floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_REMUNERAR_NOVO_USUARIO));
			$usuaid_debitar = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::USUA_ID_DEBITAR_REMUNERAR_NOVO_USUARIO);
			$descricao = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::REMUNERACAO_NOVO_USUARIO);

			$cacaccbo = new CampanhaCashbackCCBusinessImpl();
			$retcc = $cacaccbo->lancarMovimentoCashbackCC($daofactory, $dto->id, $usuaid_debitar, $vllancar, $descricao, ConstantesVariavel::CREDITO);

			$msgRemunerarNovoUsuario = MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::NOTIFICACAO_REMUNERACAO_NOVO_USUARIO,
				[
					ConstantesVariavel::P1 => $dto->apelido,
					ConstantesVariavel::P2 => Util::getMoeda($vllancar), 
				]
			);

			// Notifica o usuario
			UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $dto->id, $msgRemunerarNovoUsuario, "money.png");	

			// Envia uma notificação ao ADMIN
			UsuarioNotificacaoHelper::criarNotificacaoAdmin(
				$daofactory
				, ConstantesMensagem::NOTIFICACAO_REMUNERACAO_NOVO_USUARIO
				, [
					ConstantesVariavel::P1 => $dto->apelido,
					ConstantesVariavel::P2 => Util::getMoeda($vllancar), 
				]
				, "money.png"
			);

		}



		// Prepara objeto de retorno
		if ($seguefluxo){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		// Retorna resultado da operação
		return $retorno;

	}


	private function ativarPlanoFinanceiroUsuarioGratuito($daofactory, $dto, $planoid)
	{
		// devolve resultado ao serviço
		$retorno = new DTOPadrao();

		// Verifica condiçoes de desconto do plano gratuito
		$planogratuitoid = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO);
		if ($planoid == $planogratuitoid)
		{
			// Localiza o plano que está pendente
			$pubi = new PlanoUsuarioBusinessImpl();
			$plusid = $pubi->carregarPlanoUsuarioPorStatus($daofactory, $dto->id, ConstantesVariavel::STATUS_PENDENTE);
			//$plusdto = $pubi->carregarPorID($daofactory, $plusid->id);

			$pufbi = new PlanoUsuarioFaturaBusinessImpl();
			$plufdto = $pufbi->carregarPlanoUsuarioFaturaPorStatus($daofactory, $plusid->id, ConstantesVariavel::STATUS_PENDENTE);

			// Liquida a fatura e libera o plano pra uso imediato
			$res1 = $pufbi->liquidarPlanoUsuarioFaturaPorStatus($daofactory, $plufdto->id, ConstantesVariavel::STATUS_LIQUIDADO);
			$res2 = $pubi->atualizarPlanoUsuarioPorId($daofactory, $plusid->id, ConstantesVariavel::STATUS_ATIVO);

			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		} else {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;
	}


	private function inserirNovoPlanoFinanceiroUsuario($daofactory, $dto, $planoid)
	{
		// Localiza o plano que está pendente
		$pubi = new PlanoUsuarioBusinessImpl();
		$plusid = $pubi->carregarPlanoUsuarioPorStatus($daofactory, $dto->id, ConstantesVariavel::STATUS_PENDENTE);

		// prepara para incluir a ficha financeira 
		$date = new DateTime();

		$pufdto = new PlanoUsuarioFaturaDTO();
		$pufdto->planousuarioid = $plusid->id;
		$pufdto->valorfatura = $plusid->valor;
		$pufdto->valordesconto = 0;
		$pufdto->dataVencimento = date('Y-m-d');

		// Verifica condiçoes de desconto do plano gratuito
		$planogratuitoid = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO);
		if ($planoid == $planogratuitoid)
		{
			$pufdto->valordesconto = $pufdto->valorfatura;
		}

		$pufsi = new PlanoUsuarioFaturaBusinessImpl();
		$ok = $pufsi->inserir($daofactory, $pufdto);

		// devolve resultado ao serviço
		$retorno = new DTOPadrao();
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = $ok->msgcode;
			$retorno->msgcodeString = $ok->msgcodeString;
		}

		return $retorno;

	}

	private function inserirNovoPlanoUsuario($daofactory, $dto, $planoid)
	{
		$retorno = new DTOPadrao();

		// carrega o plano completo
		$pi = new PlanoBusinessImpl();
		$pdto = $pi->carregarPorID($daofactory, $planoid);

		// faz uma replica do plano dentro do plano usuario
		$pudto = new PlanoUsuarioDTO();
		$pudto->usuarioid = $dto->id;
		$pudto->planoid = $pdto->id;
		$pudto->nome = $pdto->nome;
		$pudto->permissao = $pdto->permissao;
		$pudto->valor = $pdto->valor;

		$pusi = new PlanoUsuarioBusinessImpl();
		$ok = $pusi->inserir($daofactory, $pudto);

		// devolve resultado ao serviço
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = $ok->msgcode;
			$retorno->msgcodeString = $ok->msgcodeString;
		}

		return $retorno;

	}


	private function enviarEmailNovaConta($daofactory, $dto)
	{
		// Envia email para conta do usuário para confirmação de identidade
		// Token de teste a ser enviado no email
		$token = $dto->codigoAtivacao;

		// LINK_ATIVACAO_NOVO_CLIENTE = *=url-ambiente-ativo=*/php/classes/gateway/ativarNovaContaController.php?token=*=token=*
		$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::LINK_ATIVACAO_NOVO_CLIENTE);
		$url = Ambiente::trocarUrlAmbienteAtivo($url);
		$url = str_replace(TagHub::TAG_TOKEN, $token,$url);

		// timestamp de teste
		$date = new DateTime();
		$ts = $date->getTimestamp();

		// prepara parametrizacao
		$email = new EmailDTO();
		$email->destinario = $dto->apelido;
		$email->emaildestinatario = $dto->email;
		$email->assunto = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::EMAIL_TITULO_PADRAO_NOVA_CONTA);
		$email->template = getcwd() . VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_TEMPLATES_EMAIL) 
							. EmailTemplateHub::NOVA_CONTA_CANIVETE;
		$email->lsttags = [	
								TagHub::NOME_NOVO_CLIENTE => $email->destinario,
								TagHub::LINK_ATIVACAO_NOVO_CLIENTE => $url,
								TagHub::TAG_CONTATO_EMAIL_CANIVETE => VariavelCache::getInstance()->getVariavel(ConstantesVariavel::EMAIL_CONTATO_PADRAO_SMTP)
							];
		//var_dump($email);

		$es = new EmailSolucionador($email);

		// Envia o email com o email já solucionado em suas tags
		$e = new Email($es);
		return $e->enviar();

	}

	/**
	 * inserir() - Inserir uma nova conta de usuario
	 * @param $daofactory
	 * @param $dto
	 * @return boolean
	 */
	private function inserirUsuarioFacebook($daofactory, $dto) 
	{
		// retorno de resultado do processo
		$retorno = new DTOPadrao();

		// prepara DTO do usuário para inserção
		$dto->pwd = $dto->pwd;
		$dto->codigoAtivacao = Util::getCodigo(128);
		$dto->tipoConta = "C";
		$dto->status = ConstantesVariavel::STATUS_ATIVO;

		// obtem interface e insere o registro
		$dao = $daofactory->getUsuarioDAO($daofactory);
		$ok = $dao->insertUsuarioFacebook($dto);

		// devolve resultado ao serviço
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	/**
	 * inserir() - Inserir uma nova conta de usuario
	 * @param $daofactory
	 * @param $dto
	 * @return boolean
	 */
	public function inserir($daofactory, $dto) 
	{
		// retorno de resultado do processo
		$retorno = new DTOPadrao();

		// prepara DTO do usuário para inserção
		$dto->pwd = sha1($dto->pwd);
		$dto->codigoAtivacao = Util::getCodigo(128);
		$dto->tipoConta = "C";

		// obtem interface e insere o registro
		$dao = $daofactory->getUsuarioDAO($daofactory);
		$ok = $dao->insert($dto);

		// devolve resultado ao serviço
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function carregarPorIDFacebook($daofactory, $id)
	{
//var_dump($id)		;
		$dao = $daofactory->getUsuarioDAO($daofactory);
		return $dao->loadIDFacebook($id);
	}

	public function carregarPorID($daofactory, $id)
	{
		$dao = $daofactory->getUsuarioDAO($daofactory);
		return $this->validarRetorno($dao->loadPK($id));
	}

	public function carregarUsuarioPeloProjeto($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoDAO($daofactory);
		return $dao->loadPK($idProjeto);
	}


	public function inserirProjetoItem($daofactory, $idProjeto, $descricao, $tipoItem)
	{
		$retorno = false;
		switch ($tipoItem) {
			case 'projeto-item':
				$dao = $daofactory->getProjetoItensDAO($daofactory);
				$dto = new ProjetoItemDTO();
				$dto->projetoid = $idProjeto;
				$dto->desc = $descricao;
				$retorno = $dao->insert($dto);
				break;
			case 'projeto-bonus':
				$dao = $daofactory->getProjetoBonusDAO($daofactory);
				$dto = new ProjetoBonusDTO();
				$dto->projetoid = $idProjeto;
				$dto->desc = $descricao;
				$retorno = $dao->insert($dto);
				break;
			case 'projeto-tecnicas':
				$dao = $daofactory->getProjetoTecnicasDAO($daofactory);
				$dto = new ProjetoTecnicaDTO();
				$dto->projetoid = $idProjeto;
				$dto->desc = $descricao;
				$retorno = $dao->insert($dto);
				break;
			case 'projeto-dores':
				$dao = $daofactory->getProjetoDoresDAO($daofactory);
				$dto = new ProjetoDorDTO();
				$dto->projetoid = $idProjeto;
				$dto->desc = $descricao;
				$retorno = $dao->insert($dto);
				break;
			case 'projeto-beneficios':
				$dao = $daofactory->getProjetoBeneficiosDAO($daofactory);
				$dto = new ProjetoBeneficioDTO();
				$dto->projetoid = $idProjeto;
				$dto->desc = $descricao;
				$retorno = $dao->insert($dto);
				break;
			
			default:
				# code...
				break;
		}

		return $retorno;
	}


	public function deletarProjetoItem($daofactory, $idpk, $tipoItem)
	{
		$retorno = false;
		switch ($tipoItem) {
			case 'projeto-item':
				$dao = $daofactory->getProjetoItensDAO($daofactory);
				$retorno = $dao->delete($idpk);
				break;
			case 'projeto-bonus':
				$dao = $daofactory->getProjetoBonusDAO($daofactory);
				$retorno = $dao->delete($idpk);
				break;
			case 'projeto-tecnicas':
				$dao = $daofactory->getProjetoTecnicasDAO($daofactory);
				$retorno = $dao->delete($idpk);
				break;
			case 'projeto-dores':
				$dao = $daofactory->getProjetoDoresDAO($daofactory);
				$retorno = $dao->delete($idpk);
				break;
			case 'projeto-beneficios':
				$dao = $daofactory->getProjetoBeneficiosDAO($daofactory);
				$retorno = $dao->delete($idpk);
				break;
			
			default:
				# code...
				break;
		}

		return $retorno;
	}


	// Carrega um objeto
	public function carregar($daofactory, $dto)
	{
		$dao = $daofactory->getUsuarioDAO($daofactory);
		return $dao->load($dto);
	}

	public function buscarTodosProjetos($daofactory, $idUsuario)
	{
		$dao = $daofactory->getProjetoDAO($daofactory);
		return $dao->listProjetosArray($idUsuario);
	}

	public function buscarTodosBonus($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoBonusDAO($daofactory);
		return $dao->listBonus($idProjeto);
	}

	public function buscarTodosItens($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoItensDAO($daofactory);
		return $dao->listItens($idProjeto);
	}

	public function buscarTodasDores($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoDoresDAO($daofactory);
		return $dao->listDores($idProjeto);
	}

	public function buscarTodasTecnicas($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoTecnicasDAO($daofactory);
		return $dao->listTecnicas($idProjeto);
	}

	public function buscarTodosBeneficios($daofactory, $idProjeto)
	{
		$dao = $daofactory->getProjetoBeneficiosDAO($daofactory);
		return $dao->listBeneficios($idProjeto);
	}

	public function carregarUsuarioPorLogin($daofactory, $email)
	{
		$dao = $daofactory->getUsuarioDAO($daofactory);
		$dto = $dao->loadUsuarioLogin($email);

		/* aproveita pra marcar a gratuidade do plano com base no plano mais recente */
		$pubi = new PlanoUsuarioBusinessImpl();
		$plus = $pubi->carregarPlanoUsuarioPorStatus($daofactory, $dto->id, ConstantesVariavel::STATUS_ATIVO);

		// Por padrão é considerado sempre negado o plano gratuito
		$dto->isGratuito = ConstantesVariavel::PLANO_GRATIS_NAO;
		
		// Trouxe as informações do plano do usuario. Então, temos a necessidade de verificar se o plano ativo
		// é o plano gratuito
		if ($plus != NULL && $plus->id != NULL && $plus->usuarioid == $dto->id) {
			if($plus->planoid == (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO)) {
				$dto->isGratuito = ConstantesVariavel::PLANO_GRATIS_SIM;				
			}
		}

		return $dto;
	}

	/* deprecated - usar carregarPorID() */
	public function carregarUsuarioPorID($daofactory, $idUsuario)
	{
		$dao = $daofactory->getUsuarioDAO($daofactory);
		return $dao->loadPK($idUsuario);

	}

	public function carregarUsuarioProjeto($daofactory, $idUsuario, $idProjeto){
		$dao = $daofactory->getProjetoDAO($daofactory);
		return $dao->loadProjetoEspecifico($idUsuario, $idProjeto);
	}

	public function carregarUsuarioProjetoBonus($daofactory, $idUsuario, $idProjeto)
	{
		$dao = $daofactory->getProjetoBonusDAO($daofactory);
		return $dao->listBonus($idProjeto);
	}

	public function inserirProjeto($daofactory, $projetodto)
	{
		$dao = $daofactory->getProjetoDAO($daofactory);
		$retorno = $dao->insert($projetodto);
		$retorno = $dao->loadProjetoRecente($projetodto->usuarioid);

		$efdto = EstatisticaFuncaoHelper::getDTO($retorno->usuarioid, $retorno->id, ConstantesEstatisticaFuncao::FUNCAO_PROJETO);
		$dao = $daofactory->getEstatisticaFuncaoDAO($daofactory);
		$dao->insert($efdto);

		return $retorno;
	}

	public function atualizarProjeto($daofactory, $projetodto)
	{
		$dao = $daofactory->getProjetoDAO($daofactory);
		return $dao->update($projetodto);
	}

	private function validarRetorno($retorno){
		if ($retorno->id == null){
			$retorno->msgcode = ConstantesMensagem::USUARIO_NAO_ENCONTRADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		} else if ($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_INATIVO){
			$retorno->msgcode = ConstantesMensagem::CONTA_USUARIO_STATUS_INATIVO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		} else if ($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_BLOQUEADO){
			$retorno->msgcode = ConstantesMensagem::CONTA_USUARIO_STATUS_BLOQUEADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
			

	}
}

?>