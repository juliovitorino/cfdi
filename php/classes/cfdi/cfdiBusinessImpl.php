<?php  

// importar dependencias
require_once 'cfdiBusiness.php';
require_once 'cfdiBusinessImpl.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../campanhaqrcode/campanhaQrCodeBusinessImpl.php';

/**
 * CfdiBusinessImpl - Implementação da classe de negocio
 */
class CfdiBusinessImpl implements CfdiBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}

	public function carimbarQrCodeCfdi($daofactory, $id_campanha, $id_fiel, $qrcode)
	{ 
		$ok = false;

		$campbo = new CampanhaBusinessImpl();
		$campdto = $campbo->carregarPorID($daofactory,$id_campanha);

		$qrcbo = new CampanhaQrCodeBusinessImpl();
		$qrcdto = $qrcbo->carregarQRCode($daofactory, $qrcode);

		$dao = $daofactory->getCfdiDAO($daofactory);

		// prepara DTO
		$dto = new CfdiDTO();
		$dto->id_campanha = $id_campanha;
		$dto->id_fiel = $id_fiel;
		$dto->qrcode = $qrcode;
		$dto->modo = "C";
		$dto->valorTicketMedioCarimbo = $campdto->valorTicketMedioCarimbo;
		$dto->status = ConstantesVariavel::STATUS_ATIVO;
		$dto->idUsuarioAutorizador = $qrcdto->idusuarioGerador;

		$ok = $dao->insert($dto);

		if ($ok) {
			if($campdto->permiteAlterarMaximoSelos == ConstantesVariavel::SIM){
				$ret = $campbo->atualizarControladorMaximoSelos($daofactory, $campdto->id);
			}

			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::TICKET_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function listarPagina($daofactory, $pag, $qtde)	
	{	
		$dao = $daofactory->getCfdiDAO($daofactory);
		return $dao->listPagina($pag, $qtde);
	}

	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getCfdiDAO($daofactory);
		return $dao->loadPK($id);
	}

	public function carregarPorCarimbo($daofactory, $carimbo)
	{ 
		$dao = $daofactory->getCfdiDAO($daofactory);
		$dto = $dao->loadCarimbo($carimbo);
		$usuabo = new UsuarioBusinessImpl();
		$dto->usuarioAutorizador = $usuabo->carregarPorID($daofactory, $dto->idUsuarioAutorizador);
		return $dto;
	}

	public function atualizarUsuarioGeradorQRCode($daofactory, $carimbo)
	{

		// Busca o carimbo na Campanha QRCode
		$cqrbo = new CampanhaQrCodeBusinessImpl();
		$cqrdto = $cqrbo->carregarQRCode($daofactory, $carimbo);

		$dao = $daofactory->getCfdiDAO($daofactory);

		// resposta padrão
		$retorno = new DTOPadrao();

		if($dao->updateUsuarioGeradorQRCode($carimbo, $cqrdto->idusuarioGerador)){	
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		} else {
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		

		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}


	public function atualizarStatus($daofactory, $id, $status)
	{
		$dao = $daofactory->getCfdiDAO($daofactory);
		$updateok = true;

		// resposta padrão
		$retorno = new DTOPadrao();

		// obtem o status atual da cfdi
		$dto = $this->carregarPorID($daofactory, $id);

		if($updateok){
			if($dao->updateStatus($idcfdi, $status)){	
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

		// Monta a regra do QRCode da Cfdi
		$dto->status = ConstantesVariavel::STATUS_ATIVO;
		$dao = $daofactory->getCfdiDAO($daofactory);

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
