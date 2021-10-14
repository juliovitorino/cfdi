<?php

/**
 * 
 * PlanoBusinessImpl
 */

require_once 'PlanoBusiness.php';
require_once 'ConstantesPlano.php';

require_once '../permissao/PermissaoDTO.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class PlanoBusinessImpl implements PlanoBusiness
{
	
	function __construct()
	{
		# code...
	}

	public function deletar($daofactory, $dto)	{}
	public function atualizar($daofactory, $dto) {}
	public function listarTudo($daofactory)	{}
	public function inserir($daofactory, $dto) {}
	
	public function listarPagina($daofactory, $pag, $qtde)	{	}

	

	// Carrega um objeto
	public function carregarPorID($daofactory, $id)
	{	
		$dao = $daofactory->getPlanoDAO($daofactory);
		$retorno = $dao->loadPK($id);
		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$retorno->lstpermissao = $this->getListaPermissao($retorno->permissao);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}

	public function carregar($daofactory, $dto)
	{
		$dao = $daofactory->getPlanoDAO($daofactory);
		$retorno = $dao->load($dto);
		if (! is_null($retorno->id)){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			$retorno->lstpermissao = $this->getListaPermissao($retorno->permissao);
		} else {
			$retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}

	/**
	* getListaPermissao() - Desmenbra uma permissao string e adiciona em uma array de PermissaoDTO
	* @param string
	* @return PermissaoDTO[]
	*/
	public function getListaPermissao($permstr)
	{
		$lstpermissao = [];
		for ($i=0; $i < strlen($permstr); $i += ConstantesPlano::MULTIPLO) { 
			$permissaostr = substr($permstr, $i, ConstantesPlano::MULTIPLO);
			if (substr($permissaostr, 0, 1) !== ConstantesPlano::STATUS_SEM_USO)
			{
				$permissao = new PermissaoDTO();
				$permissao->status = substr($permissaostr, 0, 1);
				$permissao->periodicidade = substr($permissaostr, 1, 2);
				$permissao->qtdepermitida = substr($permissaostr, 3, 5);
				if ($i/ConstantesPlano::MULTIPLO < sizeof(ConstantesPlano::lstfuncionalidade)) {
					$permissao->funcionalidade = ConstantesPlano::lstfuncionalidade[$i/ConstantesPlano::MULTIPLO];
				}

				switch ($permissao->periodicidade) {
					case 'LI':
						$permissao->periodicidadestr = 'LIVRE';
						break;
					case 'MX':
						$permissao->periodicidadestr = 'MAXIMO';
						break;
					case 'DD':
						$permissao->periodicidadestr = 'DIARIA';
						break;
					case 'SM':
						$permissao->periodicidadestr = 'SEMANAL';
						break;
					case 'QZ':
						$permissao->periodicidadestr = 'QUINZENAL';
						break;
					case 'MM':
						$permissao->periodicidadestr = 'MENSAL';
						break;
					case 'AA':
						$permissao->periodicidadestr = 'ANUAL';
						break;
					
					default:
						# code...
						break;
				}

				$lstpermissao[] = $permissao;			
			}

		}

		return $lstpermissao;
	}




}

?>