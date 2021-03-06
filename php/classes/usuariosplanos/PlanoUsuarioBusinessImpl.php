<?php

/**
 * 
 * PlanoUsuarioBusinessImpl
 */

require_once 'PlanoUsuarioBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../plano/ConstantesPlano.php';
require_once '../plano/PlanoBusinessImpl.php';
require_once '../permissao/PermissaoDTO.php';
require_once '../permissao/PermissaoFactory.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioBusinessImpl.php';

class PlanoUsuarioBusinessImpl implements PlanoUsuarioBusiness
{
	
	function __construct()
	{
		# code...
	}

	public function deletar($daofactory, $dto)	{}
	public function atualizar($daofactory, $dto) {}
	public function listarTudo($daofactory)	{}
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	public function isPlanoGratuito($daofactory, $usuarioid)
	{
		// Por padrão é considerado sempre negado o plano gratuito
		$isGratuito = false;
		$plus = $this->carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, ConstantesVariavel::STATUS_ATIVO);
		
		// Trouxe as informações do plano do usuario. Então, temos a necessidade de verificar se o plano ativo
		// é o plano gratuito
		if ($plus != NULL && $plus->id != NULL && $plus->usuarioid == $usuarioid) {
			if($plus->planoid == (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO)) {
				$isGratuito = true;				
			}
		}

		return $isGratuito;
	}
	
	public function verificarPermissaoPlano($daofactory, $usuarioid, $funcionalidade)
	{
		// Busca usuario
		$ubi = new UsuarioBusinessImpl();
		$usuariodto = $ubi->carregarPorID($daofactory, $usuarioid);

		// Prepara resultado padrão
		$permissaodto = new PermissaoDTO();
		$permissaodto->msgcode = ConstantesMensagem::AUTORIZACAO_NEGADA;
		$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($permissaodto->msgcode ,
					[	
						ConstantesMensagem::MSGTAG_NOME => $usuariodto->apelido,
						ConstantesMensagem::MSGTAG_FUNCIONALIDADE => $funcionalidade
					]);

		// Recupera o registro completo do plano ativo do usuário e suas permissoes já ajustadas
		$pusi = new PlanoUsuarioBusinessImpl();
		$plus_id_ativo = $pusi->carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, ConstantesVariavel::STATUS_ATIVO);
		$plusdto = $pusi->carregarPorID($daofactory,$plus_id_ativo->id);

		if ($plusdto->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
		{

			// Obtem a permissão da funcionalidade e verifica se está com STATUS == 'N'
			//var_dump($funcionalidade);
			//var_dump($plusdto->lstpermissao);
			$perm_funcionalidade = $plusdto->lstpermissao[$funcionalidade];

			// clona o DTO de permissao
			$permissaodto->status = $perm_funcionalidade->status;
			$permissaodto->funcionalidade = $perm_funcionalidade->funcionalidade;
			$permissaodto->periodicidade = $perm_funcionalidade->periodicidade;
			$permissaodto->periodicidadestr = $perm_funcionalidade->periodicidadestr;
			$permissaodto->qtdepermitida = $perm_funcionalidade->qtdepermitida;

			if ($perm_funcionalidade->status == ConstantesVariavel::STATUS_NEGADO)
			{
				$permissaodto->msgcode = ConstantesMensagem::AUTORIZACAO_NEGADA;
				$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($permissaodto->msgcode ,
							[	
								ConstantesMensagem::MSGTAG_NOME => $usuariodto->apelido,
								ConstantesMensagem::MSGTAG_FUNCIONALIDADE => $funcionalidade
							]);
			} else {

				// Se periodicidade for LI (Livre), libera o acesso.
				if ($perm_funcionalidade->periodicidade == ConstantesPlano::PERIODICIDADE_LIVRE)
				{
					$permissaodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
					$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($permissaodto->msgcode);
				} else {
					// Solicita a resolução para fábricas de permissoes
					$permissaofactory = PermissaoFactory::getInstance($perm_funcionalidade->periodicidade, $daofactory);
var_dump($plusdto);
var_dump($permissaodto);
					$permretornodto = $permissaofactory->resolverPermissao($plusdto, $permissaodto);

					$permissaodto->msgcode = $permretornodto->msgcode;
					$permissaodto->msgcodeString = $permretornodto->msgcodeString;
				}
			}

		}

		return $permissaodto;
	}


	public function inserir($daofactory, $dto)
	{	
		$dao = $daofactory->getPlanoUsuarioDAO($daofactory);
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

	// Carrega um objeto
	public function carregarPorID($daofactory, $id)
	{	
		$dao = $daofactory->getPlanoUsuarioDAO($daofactory);
		$retorno = $dao->loadPK($id);
		
		if ($retorno != null && ! is_null($retorno->id))
		{
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

			$pbi = new PlanoBusinessImpl();
			$retorno->lstpermissao = $pbi->getListaPermissao($retorno->permissao);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}
		return $retorno;

	}

	public function carregar($daofactory, $dto)
	{
		$dao = $daofactory->getPlanoUsuarioDAO($daofactory);
		$retorno = $dao->load($dto);
		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$pbi = new PlanoBusinessImpl();
			$retorno->lstpermissao = $pbi->getListaPermissao($retorno->permissao);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}


	public function carregarPlanoUsuarioPorStatus($daofactory, $usuarioid, $status)
	{
		$dao = $daofactory->getPlanoUsuarioDAO($daofactory);
		$maxplusid = $dao->loadPlanoUsuarioPorStatus($usuarioid, $status);
		return $this->carregarPorID($daofactory, $maxplusid);

	}

	public function atualizarPlanoUsuarioPorId($daofactory, $plusid, $status)
	{

		$dao = $daofactory->getPlanoUsuarioDAO($daofactory);
		$ok = $dao->updatePlanoUsuarioPorId($plusid, $status);

		$retorno = new DTOPadrao();
		if ($ok){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = "MSG-XXXXX";
			$retorno->msgcodeString = "erro getPlanoUsuarioDAO()::atualizarPlanoUsuarioPorId";
		}
		return $retorno;

	}



}

?>