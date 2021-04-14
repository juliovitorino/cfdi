<?php  

// importar dependencias
require_once 'traceBusiness.php';
require_once 'traceBusinessImpl.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
 * TraceBusinessImpl - Implementação da classe de negocio
 */
class TraceBusinessImpl implements TraceBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}

	public function listarPagina($daofactory, $pag, $qtde)	
	{	
		$dao = $daofactory->getTraceDAO($daofactory);
		return $dao->listPagina($pag, $qtde);
	}

	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getTraceDAO($daofactory);
		return $dao->loadPK($id);
	}

	public function atualizarStatus($daofactory, $id, $status){
		$dao = $daofactory->getTraceDAO($daofactory);
		$updateok = true;

		// resposta padrão
		$retorno = new DTOPadrao();

		// obtem o status atual da Trace
		$dto = $this->carregarPorID($daofactory, $id);

		if($updateok){
			if($dao->updateStatus($idTrace, $status)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			}		
		}
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function inserir($daofactory, $dto)
	{ 
		$ok = false;

		// Monta a regra do QRCode da Trace
		$dto->status = ConstantesVariavel::STATUS_ATIVO;
		$dao = $daofactory->getTraceDAO($daofactory);

		$retorno = new DTOPadrao();
		if ($dao->insert($dto)) {
			$ok = true;
		}

		if ($ok) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::ERRO_INESPERADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


}
?>
