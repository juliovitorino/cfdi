<?php

/**
 * 
 * PlanoUsuarioFaturaBusinessImpl
 */

require_once 'PlanoUsuarioFaturaBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../plano/ConstantesPlano.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuariosplanos/PlanoUsuarioBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';

class PlanoUsuarioFaturaBusinessImpl implements PlanoUsuarioFaturaBusiness
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
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
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

	public function liquidarPlanoUsuarioFaturaPorStatus($daofactory, $plufid, $status)
	{	
		$retorno = new DTOPadrao();
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
		$ok = $dao->updateStatusPlanoUsuarioFaturaPorId($plufid, $status);

		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;
	}


	public function carregarPlanoUsuarioFaturaPorStatus($daofactory, $plusid, $status)
	{	
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
		$retorno = $dao->loadPlanoUsuarioFaturaPorStatus($plusid, $status);
		$retorno = $this->carregarPorID($daofactory, $retorno);

		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;
	}


	public function carregarPlanoUsuarioFaturaMaisRecente($daofactory, $plusid)
	{	
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
		$retorno = $dao->loadPlanoUsuarioFaturaMaisRecente($plusid);
		$retorno = $this->carregarPorID($daofactory, $retorno);

		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;
	}


	// Carrega um objeto
	public function carregarPorID($daofactory, $id)
	{	
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
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
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
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

	public function aprovarPagamentoLiberarPlanoUsuarioFaturaPorId($daofactory, $plufid, $status)
	{
		$retorno = new DTOPadrao();
		$ok = true;

		// Obtem registro completo do pluf para ativar o plano do usuario (plus)
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
		$plufdto = $dao->loadPK($plufid);

		// Verifica se o plano j?? est?? ativo
		if ($plufdto->status == ConstantesVariavel::STATUS_ATIVO){
			$retorno->msgcode = ConstantesMensagem::FATURA_JA_FOI_PROCESSADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, ['*=plus_id=*' => $plufid] );
			$ok = false;
		}


		if ($ok) {
			// Atualiza o status da ficha financeira
			$okAprovar = $this->atualizarStatusPlanoUsuarioFaturaPorId($daofactory, $plufid, $status);


			// Libera o plano na plano_usuario
			$plusid = $plufdto->planousuarioid;
			$pubi = new PlanoUsuarioBusinessImpl();
			$okPlanoStatus = $pubi->atualizarPlanoUsuarioPorId($daofactory, $plusid, $status);

			if (
				($okAprovar->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) &&
				($okPlanoStatus->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) 
				)
			{
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = "MSG-XXXXX";
				$retorno->msgcodeString = "erro getPlanoUsuarioFaturaDAO()::atualizarStatusPlanoUsuarioFaturaPorId";
			}

		}

		return $retorno;


	}


	public function atualizarStatusPlanoUsuarioFaturaPorId($daofactory, $plufid, $status)
	{
		$dao = $daofactory->getPlanoUsuarioFaturaDAO($daofactory);
		$ok = $dao->updateStatusPlanoUsuarioFaturaPorId($plufid, $status);

		$retorno = new DTOPadrao();
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = "MSG-XXXXX";
			$retorno->msgcodeString = "erro getPlanoUsuarioFaturaDAO()::atualizarStatusPlanoUsuarioFaturaPorId";
		}
		return $retorno;

	}



}

?>