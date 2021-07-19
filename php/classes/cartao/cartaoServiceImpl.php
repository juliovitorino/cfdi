<?php

//importar dependencias
require_once 'cartaoService.php';
require_once 'cartaoBusinessImpl.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../daofactory/DAOFactory.php';


/**
 * CartaoServiceImpl - Implementação dos servicos
 */
class CartaoServiceImpl implements CartaoService
{
	
	function __construct() {	}

	public function apagar($dto) {	}
	public function pesquisar($dto) {	}
	public function atualizar($dto) {	}
	public function listarTudo() {	}

	public function cadastrar($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
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

	public function moverCartaoInteiroParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
			$retorno = $bo->moverCartaoInteiroParaOutroUsuario($daofactory, $idusuarioDono, $idusuarioDestino, $idCartao);

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

    public function moverSeloCartaoParaOutroUsuario($idusuarioDono, $idusuarioDestino, $idCartao)
	{

	}

	public function realizarAvaliacaoCartao($hash, $id_usuario, $rating, $comentario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
			$retorno = $bo->carregarPorHashResgate($daofactory, $hash);

			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

				// Obtem dados do dono da campanha (patrocinador)
				$usuabo = new UsuarioBusinessImpl();
				$usuadto = $usuabo->carregarPorID($daofactory, $retorno->id_usuario);

				if($retorno->id != null && $usuadto->id != $id_usuario){
					$retorno->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,
					[
						ConstantesVariavel::P1 => $usuadto->apelido
					]);
					$daofactory->rollback();
				} else if($retorno->id != null && ($retorno->status == ConstantesVariavel::STATUS_VALIDAR_COMPLETOU || $retorno->status == ConstantesVariavel::STATUS_VALIDAR_RESGATOU)){
					$retorno->msgcode = ConstantesMensagem::STATUS_INVALIDO_AVALIAR_CARTAO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
					$daofactory->rollback();
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_ATIVO){
					$retorno->msgcode = ConstantesMensagem::CARTAO_AINDA_NAO_PODE_SER_RESGATADO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
					$daofactory->rollback();
				}

				if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$retorno = $bo->atualizarAvaliacao($daofactory, $retorno->id, $rating, $comentario);
					if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

						$campbo = new CampanhaBusinessImpl();
						$retcamp = $campbo->atualizarTotalStar($daofactory, $retorno->id_campanha, $usuadto->id, $rating);
						if($retcamp->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
							$retorno->msgcode = ConstantesMensagem::CARTAO_AVALIADO_COM_SUCESSO;
							$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
							$daofactory->commit();
						}
					} else {
						$daofactory->rollback();
					}
				} else {
					$daofactory->rollback();
				}

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
	public function realizarConfirmacaoRecebimentoRecompensa($hash, $id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
			$retorno = $bo->carregarPorHashResgate($daofactory, $hash);

			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

				// Obtem dados do dono da campanha (patrocinador)
				$usuabo = new UsuarioBusinessImpl();
				$usuadto = $usuabo->carregarPorID($daofactory, $retorno->id_usuario);

				if($retorno->id != null && $usuadto->id != $id_usuario){
					$retorno->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,
					[
						ConstantesVariavel::P1 => $usuadto->apelido
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_RECEBEU){
					$retorno->msgcode = ConstantesMensagem::VOCE_CONFIRMOU_O_RECEBIMENTO_RECOMPENSA;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataConfirmouRecebeuRecompensa
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_ATIVO){
					$retorno->msgcode = ConstantesMensagem::CARTAO_AINDA_NAO_PODE_SER_RESGATADO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				}

				if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$retorno = $bo->atualizarStatus($daofactory, $retorno->id, ConstantesVariavel::STATUS_VALIDAR_RECEBEU);
					if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
						$retorno->msgcode = ConstantesMensagem::RECOMPENSA_RECEBIDA_COM_SUCESSO;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
						$daofactory->commit();
					}
				} else {
					$daofactory->rollback();
				}

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


	public function realizarEntregaRecompensa($hash, $id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
			$retorno = $bo->carregarPorHashResgate($daofactory, $hash);

			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

				$campbo = new CampanhaBusinessImpl();
				$campdto = $campbo->carregarPorID($daofactory, $retorno->id_campanha);

				// Obtem dados do dono da campanha (patrocinador)
				$usuabo = new UsuarioBusinessImpl();
				$usuadto = $usuabo->carregarPorID($daofactory, $campdto->id_usuario);

				if($retorno->id != null && $campdto->id_usuario != $id_usuario){
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_PERTENCE_OUTRO_PATROCINADOR;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,
					[
						ConstantesVariavel::P1 => $usuadto->apelido,
						ConstantesVariavel::P2 => $campdto->nome
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_ENTREGOU){
					$retorno->msgcode = ConstantesMensagem::RECOMPENSA_FOI_ENTREGUE;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataEntregouRecompensa
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_RECEBEU){
					$retorno->msgcode = ConstantesMensagem::VOCE_CONFIRMOU_O_RECEBIMENTO_RECOMPENSA;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataConfirmouRecebeuRecompensa
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_ATIVO){
					$retorno->msgcode = ConstantesMensagem::CARTAO_AINDA_NAO_PODE_SER_RESGATADO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				}

				if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$retorno = $bo->atualizarStatus($daofactory, $retorno->id, ConstantesVariavel::STATUS_VALIDAR_ENTREGOU);
					if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
						$retorno->msgcode = ConstantesMensagem::RECOMPENSA_ENTREGUE_COM_SUCESSO;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
						$daofactory->commit();
					}
				} else {
					$daofactory->rollback();
				}

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

	public function realizarResgateCartao($hash, $id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
			$retorno = $bo->carregarPorHashResgate($daofactory, $hash);

			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

				$campbo = new CampanhaBusinessImpl();
				$campdto = $campbo->carregarPorID($daofactory, $retorno->id_campanha);

				// Obtem dados do dono da campanha (patrocinador)
				$usuabo = new UsuarioBusinessImpl();
				$usuadto = $usuabo->carregarPorID($daofactory, $campdto->id_usuario);

				if($retorno->id != null && $campdto->id_usuario != $id_usuario){
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_PERTENCE_OUTRO_PATROCINADOR;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,
					[
						ConstantesVariavel::P1 => $usuadto->apelido,
						ConstantesVariavel::P2 => $campdto->nome
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_RESGATOU){
					$retorno->msgcode = ConstantesMensagem::CARTAO_JA_FOI_VALIDADO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataValidouCartao
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_ENTREGOU){
					$retorno->msgcode = ConstantesMensagem::RECOMPENSA_FOI_ENTREGUE;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataEntregouRecompensa
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_VALIDAR_RECEBEU){
					$retorno->msgcode = ConstantesMensagem::VOCE_CONFIRMOU_O_RECEBIMENTO_RECOMPENSA;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
					[
						ConstantesVariavel::P1 => $retorno->dataConfirmouRecebeuRecompensa
					]);
				} else if($retorno->id != null && $retorno->status == ConstantesVariavel::STATUS_ATIVO){
					$retorno->msgcode = ConstantesMensagem::CARTAO_AINDA_NAO_PODE_SER_RESGATADO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				}

				if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$retorno = $bo->atualizarStatus($daofactory, $retorno->id, ConstantesVariavel::STATUS_VALIDAR_RESGATOU);
					if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
						$retorno->msgcode = ConstantesMensagem::CARTAO_RESGATADO_COM_SUCESSO;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
						$daofactory->commit();
					}
				} else {
					$daofactory->rollback();
				}

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

	public function atualizarCartaoFavoritos($idcartao, $idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->atualizarFavoritos($daofactory, $idcartao, $idusuario); 

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


	public function atualizarCartaoLike($id, $idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->atualizarLike($daofactory, $id, $idusuario);

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

	public function atualizarStatus($id, $status)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->atualizarStatus($daofactory, $id, $status);

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
	
	public function incrementarContador($id, $qrcodecarimbo)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->incrementarContador($daofactory, $id, $qrcodecarimbo);

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

	public function listarAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios=0 )
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarAllCartaoComentarios($daofactory, $idcampanha, $isPositivo, $qtdeComentarios);
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


	public function listarCartoesFullInfoFavoritosAtivos($idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarCartoesFullInfoFavoritos($daofactory, $idusuario, ConstantesVariavel::STATUS_ATIVO);
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
	public function listarCartoesFullInfoAtivos10M($idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarCartoesFullInfo10M($daofactory, $idusuario, ConstantesVariavel::STATUS_ATIVO);
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

	public function listarCartoesFullInfoAtivos($idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarCartoesFullInfo($daofactory, $idusuario, ConstantesVariavel::STATUS_ATIVO);
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
	public function listarCartoesFullInfoProcessoResgate($idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarCartoesFullInfoProcessoResgate($daofactory, $idusuario);
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

	public function listarCartoesFullInfoCompletosAtivos($idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->listarCartoesFullInfo($daofactory, $idusuario, ConstantesVariavel::STATUS_VALIDAR_COMPLETOU);
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

	public function listarPagina($pag, $qtde)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
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

	public function pesquisarPorCampanhaUsuarioStatus($idusuario, $idcampanha, $status)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->pesquisarPorCampanhaUsuarioStatus($daofactory, $idusuario, $idcampanha, $status);
			 if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO ||
			 	$retorno->msgcode == ConstantesMensagem::CARTAO_TOTALMENTE_COMPLETO){
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

	public function pesquisarCartaoFullCarimbo($carimbo, $id_usuario, $status=ConstantesVariavel::STATUS_ATIVO)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->carregarCartaoFullCarimbo($daofactory, $carimbo, $id_usuario, $status);
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


	public function pesquisarCartaoFull($id, $id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
 			$retorno = $bo->carregarCartaoFull($daofactory, $id, $id_usuario);
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

	public function pesquisarPorID($id)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da cfdi
 			$bo = new CartaoBusinessImpl();
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


}

?>