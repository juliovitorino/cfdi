<?php

//importar dependencias
require_once '../daofactory/DAOFactory.php';

require_once 'campanhaQrCodeService.php';
require_once 'campanhaQrCodeBusinessImpl.php';

require_once '../campanha/campanhaBusinessImpl.php';
require_once '../campanha/campanhaServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../cfdi/cfdiBusinessImpl.php';
require_once '../cfdi/cfdiServiceImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../estatisticafuncao/EstatisticaFuncaoHelper.php';
require_once '../estatisticafuncao/EstatisticaFuncaoServiceImpl.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../cartao/cartaoServiceImpl.php';
require_once '../cartao/cartaoBusinessImpl.php';
require_once '../campanhacashback/CampanhaCashbackBusinessImpl.php';
require_once '../campanhacashbackcc/CampanhaCashbackCCBusinessImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoBusinessImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoDTO.php';
require_once '../usuarionotificacao/UsuarioNotificacaoServiceImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';
require_once '../selocuringa/seloCuringaServiceImpl.php';
require_once '../selocuringa/seloCuringaDTO.php';
require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';
require_once '../campanhatopdez/CampanhaTopDezBusinessImpl.php';
require_once '../permissao/PermissaoHelper.php';
require_once '../plano/ConstantesPlano.php';
require_once '../campanhasorteio/CampanhaSorteioBusinessImpl.php';
require_once '../usuariocampanhasorteio/UsuarioCampanhaSorteioBusinessImpl.php';
require_once '../fundoparticipacaoglobal/FundoParticipacaoGlobalBusinessImpl.php';
require_once '../usuariosplanos/PlanoUsuarioBusinessImpl.php';

/**
 * CampanhaQrCodeService - Implementação dos servicos
 */
class CampanhaQrCodeServiceImpl implements CampanhaQrCodeService
{
	
	function __construct() {	}

	public function apagar($dto) {	}
	public function pesquisar($dto) {	}
	public function atualizar($dto) {	}
	public function listarTudo() {	}

	public function validarQRCode($idfiel, $qrc)
	{
		// Identifica o tipo do QRCode 
		if(substr($qrc,0,2) == "01") // QRCode gerado pelo celular
		{
			$vt = $this->carregarQRCodeLivre($qrc);
			if ($vt->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				return $vt;
			}
		} else if(substr($qrc,0,2) == "02")	{ // QRCode via papel impresso
			$vt = $this->carregarQRCodeLivreImpressao($qrc);
			if ($vt->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				return $vt;
			}
		}

		return $this->validarTicket($idfiel, $vt->ticket);

	}


	public function validarTicket($idfiel, $ticket)
	{
		$lcompletou = false;

		// validar o usuario
		$ssi = new SessaoServiceImpl();
		$sessaodto = $ssi->obterRegistroDonoTokenSessao($idfiel);
		if ($sessaodto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $sessaodto;
		}

		// Carrega dados do usuário 

		$usi = new UsuarioServiceImpl();
		$usuariodto = $usi->pesquisarPorId($sessaodto->usuario);
		if ($usuariodto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $usuariodto;
		}


		$vt = $this->carregarTicketLivre($ticket);
		if ($vt->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $vt;
		}

		$cartaosi = new CartaoServiceImpl();
		$cdto = $cartaosi->pesquisarPorCampanhaUsuarioStatus($usuariodto->id, $vt->id_campanha, ConstantesVariavel::STATUS_ATIVO);

		if ($cdto->msgcode == ConstantesMensagem::CARTAO_TOTALMENTE_COMPLETO) {
			return $cdto;
		}

		// Novo Cartão? Verifica se tem lote livre
		if($cdto->id == 0 && 
			$cdto->id_usuario == 0 && 
			$cdto->id_campanha == 0
		){
			$campbo = new CampanhaServiceImpl();
			$campdto = $campbo->pesquisarPorID($vt->id_campanha);
			// Controle pela tabela de campanha - controle de overflow
			if($campdto->contadorCartoes >= $campdto->maximoCartoes){
				$campdto->msgcode = ConstantesMensagem::LIMITE_DE_CARTOES_EXCEDIDO;
				$campdto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($campdto->msgcode,[
					ConstantesVariavel::P1 => $campdto->maximoCartoes,
					ConstantesVariavel::P2 => $campdto->nome,
					ConstantesVariavel::P3 => $usuariodto->apelido,
				]);
				return $campdto;
			}
		}

		// Evitar o auto-consumo
		$campbo = new CampanhaServiceImpl();
		$campdto = $campbo->pesquisarPorID($vt->id_campanha);
		if($usuariodto->id == $campdto->id_usuario){
			$campdto->msgcode = ConstantesMensagem::AUTOCONSUMO_NEGADO;
			$campdto->msgcodeString = MensagemCache::getInstance()->getMensagem($campdto->msgcode);
			return $campdto;

		}
		// Somente usuário comum pode fazer consumo de carimbos
		if($usuariodto->tipoConta != ConstantesVariavel::CONTA_USUARIO_COMUM){
			$usuariodto->msgcode = ConstantesMensagem::CONSUMO_NEGADO_TIPO_CONTA;
			$usuariodto->msgcodeString = MensagemCache::getInstance()->getMensagem($usuariodto->msgcode);
			return $usuariodto;

		}


		// Realiza o carimbo no cartao digital
		$daofactory = NULL;
		$retorno = NULL;
		$campdto = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();


			// Verifica o sucesso de verificarPermissao
			$campcheckdto = $campbo->pesquisarPorID($vt->id_campanha);
			$permdto = PermissaoHelper::verificarPermissao($daofactory, $campcheckdto->id_usuario, ConstantesPlano::PERM_MAXIMO_CARTOES);
			if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->rollback();
				return $permdto;
			}

			// Verificar se a quantidade permitida do plano do usuário já existe na CAMP
			$cartdao = $daofactory->getCartaoDAO($daofactory);
			$qtdecaso = $cartdao->countCartaoPorCampId($campcheckdto->id);

			$qtdePermitido = (int) $permdto->qtdepermitida;
			if($qtdecaso >= $qtdePermitido) 
			{
				// Antes de dar o bloqueio tem que verificar se esse usuário que está carimbando 
				// tem vaga no cartão digital dele mais recente.
				$cartbo = new CartaoBusinessImpl();
				$cartdto = $cartbo->pesquisarPorCampanhaUsuarioStatus($daofactory, $usuariodto->id, $vt->id_campanha, ConstantesVariavel::STATUS_ATIVO);

				if( 
					( $campcheckdto->maximoSelos - $cartdto->contador == 0) || 
					( $cartdto->id_usuario == 0 && $cartdto->id_campanha == 0) 
				)
				{
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_CARTAO_ACABOU_DEVIDO_PLANO_INFERIOR;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
						ConstantesVariavel::P1 => $qtdePermitido,
					]);  
					$daofactory->rollback();
					return $retorno;
				}

			}
			
			// Finalizar o ticket fornecido pelo parceiro
			$bo = new CfdiBusinessImpl();
			$retorno = $bo->carimbarQrCodeCfdi($daofactory, $vt->id_campanha, $usuariodto->id, $vt->qrcodecarimbo);
			$cfdidto = $bo->carregarPorCarimbo($daofactory, $vt->qrcodecarimbo);

			// Busca informações do carimbo na campanha qrcodes
			$cqrbo = new CampanhaQrCodeBusinessImpl();
			$cqrdto = $cqrbo->carregarQRCode($daofactory,$vt->qrcodecarimbo);


			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$qrbo = new CampanhaQrCodeBusinessImpl();
				$retorno = $qrbo->atualizarStatusPorCarimbo($daofactory, $vt->qrcodecarimbo, ConstantesVariavel::STATUS_INATIVO);
				$retorno = $qrbo->carregarQRCode($daofactory, $vt->qrcodecarimbo);
				$ret = $bo->atualizarUsuarioGeradorQRCode($daofactory, $vt->qrcodecarimbo, $cqrdto->idusuarioGerador);

				$campbo = new CampanhaBusinessImpl();
				$retorno = $campbo->atualizarTotalCarimbados($daofactory, $vt->id_campanha);
				$campdto = $campbo->carregarPorID($daofactory, $vt->id_campanha);
				$retorno = $campbo->atualizarAcumuladoTicketMedio($daofactory, $vt->id_campanha);

				//Atualiza o Top Dez
				$catodezbo = new CampanhaTopDezBusinessImpl();
				$catodezdto = $catodezbo->incParticipacaoCampanha($daofactory, $usuariodto->id, $vt->id_campanha);

				$donobo = new UsuarioBusinessImpl();
				$donodto = $donobo->carregarPorID($daofactory,$campdto->id_usuario);

				//============================================================================
				// Emite uma notificação
				//============================================================================
				UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
					,$usuariodto->id
					, MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::PARABENS_CARIMBO, [
						ConstantesVariavel::P1 => $donodto->apelido,
						ConstantesVariavel::P2 => $campdto->nome,
						ConstantesVariavel::P3 => $campdto->recompensa,
							])
					, "qrcode.png"
					, ConstantesVariavel::TIPO_NOTIFICACAO_JSON_PATROCINADOR
					, $donodto->jsonSerialize()
				);

				// Envia uma notificação ao ADMIN se chave estiver ligada
				if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
					$usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
					$msg =  MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::NOTIFICACAO_ADMIN_NOVO_CARIMBO, [
						ConstantesVariavel::P1 => $donodto->apelido,
						ConstantesVariavel::P2 => $campdto->nome,
						ConstantesVariavel::P3 => $usuariodto->apelido,
					]);
					UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, "notify-03.png");
				}

				//-------------------------------------------------------------------------
				// Verifica se essa campanha tem alguma Campanha Sorteio ativa. status = A
				//-------------------------------------------------------------------------
				$casobo = new CampanhaSorteioBusinessImpl();
				$casodto = $casobo->pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $vt->id_campanha, ConstantesVariavel::STATUS_ATIVO);
				if(!is_null($casodto))
				{
					$uscsdto = new UsuarioCampanhaSorteioDTO();

					$uscsdto->idUsuario = $usuariodto->id;
					$uscsdto->idCampanhaSorteio = $casodto->id;
					//$uscsdto->ticket = (int) Util::getCodigoNumerico(5); /* deprecated */

					$ucsbo = new UsuarioCampanhaSorteioBusinessImpl();
					$retorno = $ucsbo->inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto);
				}

				//-------------------------------------------------------------------------------------
				// Quando usuário ganha um novo carimbo consumindo produto ou serviço no parceiro J10,
				// verifica se essa campanha permite participação paralela em uma campanha de sorteio
				// do Junta10 além da que ela mesma está promovendo
				//-------------------------------------------------------------------------------------
				$casocheckj10 = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CAMPANHA_SORTEIO_J10_PARALELA);
				if(
					($campdto->permiteCampanhaSorteioJ10)  
					&& (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_PERMITIR_CAMPANHA_SORTEIO_J10_PARALELA) == ConstantesVariavel::ATIVADO)
					// && (!is_null(casodto))
					// && ($casocheckj10 != $casodto->id)
				)
				{
					$uscsdto = new UsuarioCampanhaSorteioDTO();

					$uscsdto->idUsuario = $usuariodto->id;
					$uscsdto->idCampanhaSorteio = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CAMPANHA_SORTEIO_J10_PARALELA);
					//$uscsdto->ticket = (int) Util::getCodigoNumerico(5); /* deprecated */

					$ucsbo = new UsuarioCampanhaSorteioBusinessImpl();
					$retorno = $ucsbo->inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto, true);

				}

				//-------------------------------------------------------------------------------------
				// Verifica se essa campanha permite que o dono da campanha seja remunerado
				// para que ele incentive fique sempre com o Junta10 na cabeça
				//-------------------------------------------------------------------------------------
				if(
					($campdto->permiteBonificarCarimboDonoCampanha) && 
					(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_INCENTIVAR_DONO_CAMPANHA_CARIMBAR) == ConstantesVariavel::ATIVADO) 
				)
				{
					$vlrIncentivo =  floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_INCENTIVAR_DONO_CAMPANHA_CARIMBAR));
					$vlrLimite =  floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_LIMITE_TETO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR));
					$usuaid_debito = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::USUA_ID_DEBITO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR);

					// se o saldo em cashback do dono da campanha ultrapassou o limite teto, ignora a remuneração
					$csisaldo = new CampanhaCashbackCCBusinessImpl();
					$saldodto = $csisaldo->getSaldoCashbackCC($daofactory, $campdto->id_usuario);
					if($saldodto != NULL && $saldodto->vlsldGeral < $vlrLimite)
					{
						$caccbo = new CampanhaCashbackCCBusinessImpl();
						$descricao_bonificacao = MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::MSG_CASHBACK_INCENTIVAR_DONO_CAMPANHA_CARIMBAR, [
							ConstantesVariavel::P1 => Util::getMoeda($vlrIncentivo),
							ConstantesVariavel::P2 => $campdto->nome,
						]);
						$retcredito = $caccbo->CreditarCashbackCC($daofactory, $campdto->id_usuario, $usuaid_debito, $vlrIncentivo, $descricao_bonificacao);

						// notifica o usuário dono da campanha
						UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
							, $campdto->id_usuario
							, $descricao_bonificacao
							,"money.png");

						// notifica o admin
						UsuarioNotificacaoHelper::criarNotificacaoAdmin($daofactory
							, ConstantesMensagem::MSG_CASHBACK_INCENTIVAR_DONO_CAMPANHA_CARIMBAR
							, [
								ConstantesVariavel::P1 => Util::getMoeda($vlrIncentivo),
								ConstantesVariavel::P2 => $campdto->nome,
							]
						);
					}
				}

				//-------------------------------------------------------------------------------------
				// Verifica se essa campanha permite bonificação especial J10 dando um $$$ pelo carimbo
				// lanca um credito na campanha J10 (CACA_ID) noo cashback
				//-------------------------------------------------------------------------------------
				if( 
					($campdto->permiteBonificarCarimboJ10) &&
					(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_PERMITIR_BONIFICACAO_J10) == ConstantesVariavel::ATIVADO) 
				)
				{
					$vllancar = floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_CASHBACK_CC_BONIFICACAO_J10));
					$cacaid_bonificacao = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CASHBACK_BONIFICACAO_J10);

					$cacabo_bonificacao = new CampanhaCashbackBusinessImpl();
					$cacadto_bonificacao = $cacabo_bonificacao->carregarPorID($daofactory, $cacaid_bonificacao);
					
					$caccbo = new CampanhaCashbackCCBusinessImpl();
					
					$descricao_bonificacao = MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::MSG_CASHBACK_BONIFICACAO_J10, [
						ConstantesVariavel::P1 => Util::getMoeda($vllancar),
						ConstantesVariavel::P2 => $campdto->nome,
					]);
					$retcredito = $caccbo->CreditarCashbackCC($daofactory, $usuariodto->id, $cacadto_bonificacao->id_usuario, $vllancar, $descricao_bonificacao);
				}

				//-----------------------------------------------------------
				// Verifica se a Chave Geral do PRograma Cashback está ligada
				//-----------------------------------------------------------
				if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_PROGRAMA_CASHBACK) == ConstantesVariavel::ATIVADO){

					// Pesquisa o MaxID de Usuario x Cashback
					$uscabo = new UsuarioCashbackBusinessImpl(); 
					$uscadto = $uscabo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $campdto->id_usuario,ConstantesVariavel::STATUS_ATIVO);

					// Campanha permite participação em campanhas de cashback?
					if($campdto->permissaoCashback == ConstantesVariavel::SIM && ! is_null($uscadto)) {
						$cashbo = new CampanhaCashbackBusinessImpl();

						$cashdto = $cashbo->PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus($daofactory, $campdto->id_usuario, $campdto->id, ConstantesVariavel::STATUS_ATIVO);
						// se o ticket médio do carimbo for acima do valor minimo do cashback, ok.

						if (
							($cashdto != null) &&
							($cashdto->id != null) &&
							($uscadto != null) &&
							($uscadto->id != null) &&
							($cashdto->status == ConstantesVariavel::STATUS_ATIVO) &&
							($uscadto->status == ConstantesVariavel::STATUS_ATIVO)
							// &&
							//(($uscadto->percentual > 0) ||	($cashdto->percentual >= 0))
						)
						{
							$perccalc = $cashdto->percentual == 0 ?$uscadto->percentual :$cashdto->percentual;

							// calcula o cashback e insere no conta corrente
							$vlcashback = $campdto->valorTicketMedioCarimbo * ( $perccalc / 100);

							$cashccbo = new CampanhaCashbackCCBusinessImpl();
							$cashccdto = new CampanhaCashbackCCDTO();
							$cashccdto->id_cashback = $cashdto->id;
							$cashccdto->id_campanha = $campdto->id;
							$cashccdto->id_usuario = $usuariodto->id;
							$cashccdto->id_dono = $campdto->id_usuario;
							$cashccdto->id_cfdi = $cfdidto->id;
							$cashccdto->descricao = "Consumo na campanha " . $campdto->nome;
							$cashccdto->percentual = $perccalc;
							$cashccdto->vlConsumo = $campdto->valorTicketMedioCarimbo;
							$cashccdto->vlCalcRecompensa = $vlcashback;
							$cashccdto->tipoMovimento = ConstantesVariavel::CREDITO;

							// Se calculo do cashback der Zero, apenas ignora novo registro
							if($vlcashback > 0 && $cashccbo->inserir($daofactory, $cashccdto)){

								UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
									,$usuariodto->id
									, MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::PARABENS_CASHBACK, [
										ConstantesVariavel::P1 => Util::getMoeda($vlcashback),
										ConstantesVariavel::P2 => $cashccdto->descricao,
										ConstantesVariavel::P3 => $donodto->apelido
									])
									, "money.png"
									, ConstantesVariavel::TIPO_NOTIFICACAO_CONTA_CASHBACK_CC
									, $donodto->jsonSerialize()
								);
			
							}
						}
					}

				}

				//------------------------------------------------------------------------------------------------
				// Lançar movimento sobre o Fundo de Participação Global e o conta corrente do usuário bonificado
				//------------------------------------------------------------------------------------------------
				$fpglbo = new FundoParticipacaoGlobalBusinessImpl();
				$fpglbo->lancarMovimentoFundoParticipacaoGlobal($daofactory
					, $campdto->id_usuario
					, $usuariodto->id
					, floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL))
					, MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::AVISO_CREDITO_FUNDO_PARTICIPACAO_GLOBAL,[
						ConstantesVariavel::P1 => $usuariodto->apelido,
						ConstantesVariavel::P2 => Util::getMoeda(floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL))),
					])
				);

/* PODE APAGAR EM FUTURO MOMENTO -- CODIGO FOI SUBSTITUIDO POR UMA FUNÇÃO DE USO GERAL DENTRO DAS CLASSES FPGL
				//-------------------------------------------------------
				// Verifica a Chave Geral do Fundo de Participação Global
				//-------------------------------------------------------
				if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_FUNDO_PARTICIPACAO_GLOBAL_FPGL) == ConstantesVariavel::ATIVADO)
				{
					$okfpgl = true;

					//------------------------------------------
					// Aplica regras de negócio para FPGL e CACC
					//------------------------------------------

					// Somente planos pagos
					$plusfpglbo = new PlanoUsuarioBusinessImpl();
					if($plusfpglbo->isPlanoGratuito($daofactory, $campdto->id_usuario))
					{
						$okfpgl = false;
					}

					//---> colocar verificacao da permissao do plano porque nem todo plano pago permite retiradda do FPGL
					$permdto = PermissaoHelper::verificarPermissao($daofactory,$campdto->id_usuario, ConstantesPlano::PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL);
					if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
						$okfpgl = false;
					}

					// dono da campanha tem que ter registro na USCA
					$uscafpglbo = new UsuarioCashbackBusinessImpl();
					$uscafpgldto = $uscafpglbo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $campdto->id_usuario, ConstantesVariavel::STATUS_ATIVO);
					if(is_null($uscafpgldto))
					{
						$okfpgl = false;
					}

					if($okfpgl)
					{
						// Tudo Ok. Pode realizar o pagamento ao cliente que carimbou
						$dtofpgl = new FundoParticipacaoGlobalDTO();
	
						$dtofpgl->idUsuarioParticipante = $campdto->id_usuario;
						$dtofpgl->idUsuarioBonificado = $usuariodto->id;
						$dtofpgl->valorTransacao = floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL)) * -1;
						$dtofpgl->descricao = MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::AVISO_CREDITO_FUNDO_PARTICIPACAO_GLOBAL,[
							ConstantesVariavel::P1 => $usuariodto->apelido,
							ConstantesVariavel::P2 => Util::getMoeda($dtofpgl->valorTransacao * -1),
						]);

						$fpglbo = new FundoParticipacaoGlobalBusinessImpl();
						$retfpgl = $fpglbo->inserirCreditoBonificacao($daofactory, $dtofpgl);
	
						// Pode inserir o registro de crédito o cashback_cc?
						if($retfpgl->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
						{
							$caccfpglbo = new CampanhaCashbackCCBusinessImpl();
							$retfpgl = $caccfpglbo->lancarMovimentoCashbackCC($daofactory, $usuariodto->id, $campdto->id_usuario, $dtofpgl->valorTransacao * -1, $dtofpgl->descricao, ConstantesVariavel::CREDITO);

						}
					}	
				}
*/
			}

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		// Realiza a contabilização do cartão
		if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			$cartaosi = new CartaoServiceImpl();
			$cdto = $cartaosi->pesquisarPorCampanhaUsuarioStatus($usuariodto->id, $vt->id_campanha, ConstantesVariavel::STATUS_ATIVO);

			if ($cdto->id == null){
				$cdto = new CartaoDTO();
				$cdto->id_campanha = $vt->id_campanha;
				$cdto->id_usuario = $usuariodto->id;
				$cdto = $cartaosi->cadastrar($cdto);
				if ($cdto->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$cdto = $cartaosi->pesquisarPorCampanhaUsuarioStatus($usuariodto->id, $vt->id_campanha, ConstantesVariavel::STATUS_ATIVO);

					// Incrementa contador de cartão na campanha
					$campsi = new CampanhaServiceImpl();
					$campdto = $campsi->pesquisarPorID($vt->id_campanha);
					$temp = $campsi->incrementarContadorCartaoDistribuido($campdto->id);
				}
			}
			if ($cdto->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
				if($cdto->carimbos == null){
					$cdto->carimbos = $vt->qrcodecarimbo;
				} else {
					$cdto->carimbos = $cdto->carimbos . ';' . $vt->qrcodecarimbo;
				}
				$temp = $cartaosi->incrementarContador($cdto->id, $cdto->carimbos);
				
				//Completou cartela?
				$cdto = $cartaosi->pesquisarPorID($cdto->id);

				if(!is_null($cdto) && ! is_null($cdto->id) ){
					if($cdto->contador == $campdto->maximoSelos){
						$temp = $cartaosi->atualizarStatus($cdto->id, ConstantesVariavel::STATUS_VALIDAR_COMPLETOU);
						$lcompletou = true;
					}
				}
			}
		}


		// registra a estatistica
		if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			EstatisticaFuncaoHelper::registrarEstatisticaService($usuariodto->id, $vt->id_campanha,ConstantesEstatisticaFuncao::FUNCAO_CONTAGEM_CFDI);
		}

		if ($lcompletou){
			//============================================================================
			// Emite uma notificação
			//============================================================================
			UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorService($usuariodto->id
				, MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::CARTAO_ACABOU_DE_COMPLETAR_NOTIFY, [
					ConstantesVariavel::P1 => $campdto->nome,
					ConstantesVariavel::P2 => $donodto->apelido,
					ConstantesVariavel::P3 => $campdto->recompensa,
				])
				, "presente.png"
				, ConstantesVariavel::TIPO_NOTIFICACAO_JSON_PATROCINADOR
				, $donodto->jsonSerialize()
			);


			//============================================================================
			// Emite um selo curinga
			//============================================================================
			$scsi = new SeloCuringaServiceImpl();
			$dto = new SeloCuringaDTO();
			$dto->id_usuario = $usuariodto->id;
			$dto->id_campanha = $vt->id_campanha;
			$dto->id_cartao = $cdto->id;
			$dto->id_autorizador = $donodto->id;
			$dto->qrcode = sha1($vt->id_campanha . Util::getCodigo(2048));

			$retorno = $scsi->cadastrar($dto);
			
			// Mensagem de saída
			$retorno->msgcode = ConstantesMensagem::CARTAO_ACABOU_DE_COMPLETAR;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		} else {
			if($cdto->contador == ($campdto->maximoSelos-1)){
				$retorno->msgcode = ConstantesMensagem::CARTAO_FALTA_APENAS_UM_CARIMBO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

			} else {

				// Garante o usuario autorizador (JCV)
				$temp = new CfdiServiceImpl();
				$tempdto = $temp->pesquisarPorCarimbo($vt->qrcodecarimbo);
				$temp = new UsuarioServiceImpl();
				$retorno->usuarioAutorizador = $temp->pesquisarPorID($tempdto->idUsuarioAutorizador);

				$retorno->msgcode = ConstantesMensagem::CARTAO_CARIMBADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1 => $cdto->contador
				]);
			}

		}

		return $retorno;
	}


	public function carregarQRCodeLivre($qrc)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Finalizar o ticket fornecido pelo parceiro
 			$bo = new CampanhaQrCodeBusinessImpl();
			$retorno = $bo->carregarQRCodeLivre($daofactory, $qrc);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function carregarQRCodeLivreImpressao($qrc)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Finalizar o ticket fornecido pelo parceiro
 			$bo = new CampanhaQrCodeBusinessImpl();
			$retorno = $bo->carregarQRCodeLivreImpressao($daofactory, $qrc);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function carregarTicketLivre($ticket)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Finalizar o ticket fornecido pelo parceiro
 			$bo = new CampanhaQrCodeBusinessImpl();
			$retorno = $bo->carregarTicketLivre($daofactory, $ticket);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function criarCarimbosCampanha($idcampanha)
	{
		$daofactory = NULL;
		$retorno = NULL;
		$ok = false;
		$seguefluxo = true;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			// Campanha existe?
			$cbo = new CampanhaBusinessImpl();
			$dto = $cbo->carregarPorID($daofactory, $idcampanha);

			if ($dto->id == null){
				$retorno = new DTOPadrao();
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			} else if ($cbo->isCampanhaAtiva($daofactory, $idcampanha)){
				// Verifica se a campanha já está ativa
				$retorno = new DTOPadrao();
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_JA_ESTA_ATIVA;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			} else if($dto->status != ConstantesVariavel::STATUS_TRABALHANDO){
				$retorno = new DTOPadrao();
				$retorno->msgcode = ConstantesMensagem::REQUISICAO_NAO_PODE_SER_PROCESSADA;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$seguefluxo = false;
			}

			if($seguefluxo){

				// Finalizar o ticket fornecido pelo parceiro
				$bo = new CampanhaQrCodeBusinessImpl();
				$retorno = $bo->criarCarimbosCampanha($daofactory, $idcampanha);
				if($retorno){
					$ok = true;
					$retorno = new DTOPadrao();
					$retorno->msgcode = ConstantesMensagem::CARIMBOS_CRIADOS_COM_SUCESSO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				}
			}

 			if ($ok) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function finalizarTicket($ticket)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Finalizar o ticket fornecido pelo parceiro
 			$bo = new CampanhaQrCodeBusinessImpl();
			$retorno = $bo->atualizarStatusPorTicket($daofactory, 
						$ticket,
						ConstantesVariavel::STATUS_FINALIZADO);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function cadastrar($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->inserir($daofactory, $dto);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
				$daofactory->commit();
			} else {
				$daofactory->rollback();
			}
			
		} catch (Exception $e) {
			// rollback na transação
			$daofactory->rollback();

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}

	public function listarPagina($pag, $qtde)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->listarPagina($daofactory, $pag, $qtde);
			$daofactory->commit();
			
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->carregarPorID($daofactory, $id);
 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
				$daofactory->commit();
 			} else {
				$daofactory->rollback();
 			}
			
		} catch (Exception $e) {
			// rollback na transação

		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


/**
*
* listarCampanhaQrCodeIdCampanhaPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

	public function listarCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();

			//Se qtde por página é indefinido (=0) busca valor default do variavel
			if($qtde == 0){
				$qtde = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT);
			}
			// listar paginado CampanhaQrCode
			$bo = new CampanhaQrCodeBusinessImpl();
			$retorno = $bo->listarCampanhaQrCodeIdCampanhaPorStatus($daofactory, $idcampanha, $status, $pag, $qtde, $coluna, $ordem);
			$daofactory->commit();
		} catch (Exception $e) {
			// rollback na transação
		
		} finally {
			try {
				$daofactory->close();
			} catch (Exception $e) {
				// faz algo
			}
		}

		return $retorno;
	}


}

?>