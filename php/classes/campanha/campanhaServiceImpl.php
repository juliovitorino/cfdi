<?php

//importar dependencias
require_once 'campanhaService.php';
require_once 'campanhaBusinessImpl.php';

require_once '../campanhaqrcode/campanhaQrCodeServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
 * CampanhaServiceImpl - Implementação dos servicos
 */
class CampanhaServiceImpl implements CampanhaService
{
	
	function __construct() {	}

	
	public function listarTudo() {	}
	public function pesquisar($dto){ }

	public function adicionarMaisCartoes($id_campanha, $id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->adicionarMaisCartoes($daofactory, $id_campanha, $id_usuario);

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
	


	public function incrementarContadorCartaoDistribuido($id_campanha)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->incrementarContadorCartaoDistribuido($daofactory, $id_campanha);

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
	
	public function atualizar($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->atualizar($daofactory, $dto);

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


	public function apagar($dto) 
	{
		$daofactory = NULL;
		$proximopasso = true;
		$retorno = new DTOPadrao();
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Pesquisa o usuário e campanha para avaliar regras 
			$usbo = new UsuarioBusinessImpl();
			$usdto = $usbo->carregarPorID($daofactory, $dto->id_usuario);

			$bo = new CampanhaBusinessImpl();
			$dto = $bo->carregarPorID($daofactory, $dto->id);

			if($dto->id != null){
				// Campanha já saiu da fila de criação de carimbo?
				if($dto->status != ConstantesVariavel::STATUS_FILA){
					if($dto->status == ConstantesVariavel::STATUS_ATIVO && $dto->totalCarimbados > 0 && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_ATIVA_NAO_PODE_SER_EXCLUIDA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome,
							ConstantesVariavel::P2 => $dto->totalCarimbados
						]);
					}
					if($usdto->id == null && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::USUARIO_INVALIDO_PARA_CAMPANHA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
					} else {
						if($usdto->id != $dto->id_usuario && $proximopasso ){
							$proximopasso = false;
							$retorno->msgcode = ConstantesMensagem::CAMPANHA_PERTENCE_OUTRO_PATROCINADOR;
							$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);	
						}
					}
					if($dto->status == ConstantesVariavel::STATUS_PURGE && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_AGUARDANDO_PURGE;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome
						]);
					}
					if($dto->status == ConstantesVariavel::STATUS_INATIVO && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_INATIVADA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome
						]);
					}
				}
			} else {
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$proximopasso = false;
			}

			if ($proximopasso){

				if ($bo->deletar($daofactory, $dto)){
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_EXCLUIDA_COM_SUCESSO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
						ConstantesVariavel::P1 => $dto->nome
					]);
					$daofactory->commit();

				} else {
				   $daofactory->rollback();
			   }

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

	public function cancelar($dto) 
	{
		$daofactory = NULL;
		$proximopasso = true;
		$retorno = new DTOPadrao();
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// Pesquisa o usuário e campanha para avaliar regras 
			$usbo = new UsuarioBusinessImpl();
			$usdto = $usbo->carregarPorID($daofactory, $dto->id_usuario);

			$bo = new CampanhaBusinessImpl();
			$dto = $bo->carregarPorID($daofactory, $dto->id);

			if($dto->id != null){
				// Campanha criada com carimbos, mas ainda não distribuída
				if($dto->status == ConstantesVariavel::STATUS_PURGE && $proximopasso){
					$proximopasso = false;
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_AGUARDANDO_PURGE;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
						ConstantesVariavel::P1 => $dto->nome
					]);
				} else {
					if($dto->status == ConstantesVariavel::STATUS_ATIVO && $dto->totalCarimbados > 0 && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_ATIVA_NAO_PODE_SER_EXCLUIDA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome,
							ConstantesVariavel::P2 => $dto->totalCarimbados
						]);
					}
					if($usdto->id == null && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::USUARIO_INVALIDO_PARA_CAMPANHA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
					} else {
						if($usdto->id != $dto->id_usuario && $proximopasso ){
							$proximopasso = false;
							$retorno->msgcode = ConstantesMensagem::CAMPANHA_PERTENCE_OUTRO_PATROCINADOR;
							$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);	
						}
					}
					if($dto->status == ConstantesVariavel::STATUS_FILA && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_NA_FILA_PARA_CRIACAO_CARIMBOS;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome
						]);
					}
					if($dto->status == ConstantesVariavel::STATUS_INATIVO && $proximopasso){
						$proximopasso = false;
						$retorno->msgcode = ConstantesMensagem::CAMPANHA_INATIVADA;
						$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
							ConstantesVariavel::P1 => $dto->nome
						]);
					}
				}
			} else {
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				$proximopasso = false;
			}

			if ($proximopasso){
				if ($bo->atualizarStatus($daofactory, $dto->id, ConstantesVariavel::STATUS_PURGE)){
					$retorno->msgcode = ConstantesMensagem::CAMPANHA_CANCELADA_COM_SUCESSO;
					$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
						ConstantesVariavel::P1 => $dto->nome
					]);
					$daofactory->commit();

				} else {
				   $daofactory->rollback();
			   }

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


	public function criarCampanhaCarimbosPendentesProduzir($id_usuario, $id_campanha)
	{
		// retorno padão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$daofactory = NULL;

		$dto = $this->pesquisarPorID($id_campanha);

		if($dto != null){
			if($dto->id == null){
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
				return $retorno;	
			}
			if($dto->id != null && $dto->id_usuario != $id_usuario){
				$retorno->msgcode = ConstantesMensagem::ERRO_USUARIO_DIFERENTE_PATROCINADOR;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
				return $retorno;
			}
		} else {
			$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
			return $retorno;
		}

		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// cria cada carimbo digital conforme suas regras
			$cqrsi = new CampanhaQrCodeBusinessImpl();
			$order = 1;
			$ret = $cqrsi->criarCarimbosCampanhaPendentesProduzir($daofactory, $id_campanha, $id_usuario);

			if($ret->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
				$retorno->msgcode = $ret->msgcode;
				$retorno->msgcodeString = $ret->msgcodeString;		
				$daofactory->commit();
			} else {
				$retorno->msgcode = $ret->msgcode;
				$retorno->msgcodeString = $ret->msgcodeString;		
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



	public function criarCampanhaPorParceiroCampanha($id_usuario, $id_campanha)
	{
		// retorno padão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$daofactory = NULL;

		$dto = $this->pesquisarPorID($id_campanha);

		if($dto != null){
			if($dto->id == null){
				$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
				return $retorno;	
			}
			if($dto->id != null && $dto->status != ConstantesVariavel::STATUS_FILA){
				$retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_CAMPANHAS_NA_FILA_PARA_PROCESSAR;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
				return $retorno;
			}
			if($dto->id != null && $dto->id_usuario != $id_usuario){
				$retorno->msgcode = ConstantesMensagem::ERRO_USUARIO_DIFERENTE_PATROCINADOR;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
				return $retorno;
			}
		} else {
			$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);		
			return $retorno;
		}

		// Troca todos os status de cada campanha pra garantir que este processo é o único dono 
		// e evitar concorrência de processos
		$ok = $this->autalizarStatusCampanha($id_campanha, ConstantesVariavel::STATUS_TRABALHANDO);

		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// cria cada carimbo digital conforme suas regras
			$cqrsi = new CampanhaQrCodeBusinessImpl();
			$order = 1;
			$ret = $cqrsi->criarCarimbosCampanha($daofactory, $id_campanha, $id_usuario);
			if($ret == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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

	public function criarCampanhasEmFila(){
		// retorno padão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
	

		// Busca as campanhas pendentes e trava seus status
		$lst = $this->listarCampanhasPorStatus(ConstantesVariavel::STATUS_FILA);

		if($lst == null){
			$retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_CAMPANHAS_NA_FILA_PARA_PROCESSAR;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);	
		} else if (count($lst) == 0) {
			$retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_CAMPANHAS_NA_FILA_PARA_PROCESSAR;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);	
		} else {
			// Troca todos os status de cada campanha pra garantir que este processo é o único dono e evitar concorrência
			foreach ($lst as $campdto) {
				$ok = $this->autalizarStatusCampanha($campdto->id, ConstantesVariavel::STATUS_TRABALHANDO);
			}

			// cria cada carimbo digital conforme suas regras
			$cqrsi = new CampanhaQrCodeServiceImpl();
			$order = 1;
			foreach ($lst as $campdto) {
				$retorno = $cqrsi->criarCarimbosCampanha($campdto->id);
				if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
					$retorno = $this->autalizarStatusCampanha($campdto->id, ConstantesVariavel::STATUS_ATIVO);
				}
			}
		}

		return $retorno;
	}

	public function atualizarTotalLike($idcampanha, $idusuario, $islike)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->atualizarTotalLike($daofactory, $idcampanha, $idusuario, $islike);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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


	public function atualizarTotalStar($idcampanha, $idusuario, $star)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->atualizarTotalStar($daofactory, $idcampanha, $idusuario, $star);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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


	public function autalizarStatusCampanha($id_campanha, $status)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->atualizarStatus($daofactory, $id_campanha, $status);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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


	public function autalizarImagemCampanha($id_campanha, $nomearquivo)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->autalizarImagemCampanha($daofactory, $id_campanha, $nomearquivo);

 			if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
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


	public function getCarimboLivre($idcampanha, $idusuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->getCarimboLivre($daofactory, $idcampanha, $idusuario);

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

	public function cadastrarFlash($dto)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->inserirFlash($daofactory, $dto);

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

	public function listarCampanhasPorStatus($status)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->listarCampanhasPorStatus($daofactory, $status);
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

	public function listarCampanhasParticipantes($id_campanha, $id_usuario, $pag)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->listarCampanhasParticipantes($daofactory, $id_campanha, $id_usuario, $pag);
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

	public function listarCampanhasUsuario($id_usuario)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new CampanhaBusinessImpl();
 			$retorno = $bo->listarCampanhasUsuario($daofactory, $id_usuario);
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


}

?>