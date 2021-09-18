<?php  

// importar dependencias
require_once 'campanhaQrCodeBusiness.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelHelper.php';
require_once '../util/util.php';
require_once '../cartaopedido/CartaoPedidoBusinessImpl.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../filaqrcodependenteproduzir/FilaQRCodePendenteProduzirBusinessImpl.php';

/**
 * CampanhaQrCodeBusinessImpl - Implementação da classe de negocio
 */
class CampanhaQrCodeBusinessImpl implements CampanhaQrCodeBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}

	public function carregarQRCode($daofactory, $qrcode)
	{
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno = $dao->loadQRCode($qrcode);

		if ($retorno != null) {
			$retorno = $this->carregarPorID($daofactory, $retorno->id);
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ERRO_ACABOU_CARIMBO_CAMPANHA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function carregarCaqrIdLivre($daofactory, $idcampanha)
	{
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno = $dao->loadCaqrIdLivre($idcampanha);

		if ($retorno != null) {
			$retorno = $this->carregarPorID($daofactory, $retorno);
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ERRO_ACABOU_CARIMBO_CAMPANHA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function carregarQRCodeLivre($daofactory, $qrc)
	{ 
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno = $dao->loadQRCodePorStatus($qrc, ConstantesVariavel::STATUS_ATIVO);

		if ($retorno != null && $retorno->id != null) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::TICKET_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function carregarQRCodeLivreImpressao($daofactory, $qrc)
	{ 
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno = $dao->loadQRCodeImpressaoPorStatus($qrc, ConstantesVariavel::STATUS_ATIVO);

		if ($retorno != null && $retorno->id != null) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::TICKET_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function carregarTicketLivre($daofactory, $ticket)
	{ 
		$ok = false;

		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno = $dao->loadTicketPorStatus($ticket, ConstantesVariavel::STATUS_ATIVO);

		if ($retorno != null && $retorno->id != null) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::TICKET_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function adicionarMaisCarimbosCampanha($daofactory, $capeid) 
	{
		// Obtem registro do pedido de cartões adicionais
		$capebo = new CartaoPedidoBusinessImpl(); 
		$capedto = $capebo->carregarPorID($daofactory, $capeid);

		$campbo = new CampanhaBusinessImpl();
		$dto = $campbo->carregarPorID($daofactory, $capedto->id_campanha);
		
		//----------------------------------------------------------------------
		// Inserir o maximo de qrcodes validos (carimbos) na Campanha Qr Codes
		// Padrão está demarcado na variavel MAXIMO_QRCODE_CARIMBO_POR_CARTAO 
		//----------------------------------------------------------------------
		//$max = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_QRCODE_CARIMBO_POR_CARTAO);
		$max = $capedto->selos;
		$first = true;
		$date = new DateTime();
		$ts = $date->getTimestamp();
		$parent = sha1($capedto->id_campanha . $ts . Util::getCodigo(1024));
		$totalFabricar = $capedto->qtde * $max;

		for ($i=0; $i < $totalFabricar; $i++) { 

			$cqrdto = new CampanhaQrCodeDTO();
			$cqrdto->id_campanha = $capedto->id_campanha;
			$cqrdto->parent = $parent;
			$cqrdto->order = $i + 1;			
			$cqrdto->idusuarioGerador = $dto->id_usuario;
			$cqrdto = $this->inserir($daofactory, $cqrdto);
			$parent = $cqrdto->id;

			//----------------------------------------------------------------------
			// como é a primeira campanha atualiza o primeiro carimbo de liberacao
			//----------------------------------------------------------------------
			if ($first){
				$first = false;
				$campbo = new CampanhaBusinessImpl();
				$ret = $campbo->atualizarProximoQrCode($daofactory, $capedto->id_campanha, $cqrdto->id);
			}
		}

		//----------------------------------------------------------------------
		// Volta Status da CAMP e CAPE para Ativos
		//----------------------------------------------------------------------

		$cbo = new CampanhaBusinessImpl();
		$cbo->atualizarStatus($daofactory, $capedto->id_campanha, ConstantesVariavel::STATUS_ATIVO);
		$capebo->atualizarStatus($daofactory, $capedto->id, ConstantesVariavel::STATUS_ATIVO);

		//----------------------------------------------------------------------
		// Atualiza contador de cartões adicionais na campanha
		//----------------------------------------------------------------------

		$cbo->atualizarTotalCarimbosAdicionados($daofactory, $capedto->id_campanha, $totalFabricar);
		$cbo->atualizarTotalCartoesAdicionados($daofactory, $capedto->id_campanha, $capedto->qtde);
		return true;
	}


	/**
	 * criarCarimbosCampanhaPendentesProduzir - Realizar a criação de carimbos que ficaram 
	 * pendentes de criação na fila de produção
	 * 
	 * @param daofactory
	 * @param idcampanha
	 * @param id_usuario
	*/
	public function criarCarimbosCampanhaPendentesProduzir($daofactory, $idcampanha, $id_usuario) 
	{
		// Obtem DTO da campanha JCV
		$daocampanha = $daofactory->getCampanhaDAO($daofactory);
		$dto = $daocampanha->loadPK($idcampanha);
		$dto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);

		//----------------------------------------------------------------------
		// Obtem um registro na fila de produção pendente
		//----------------------------------------------------------------------
		$fqppbo = new FilaQRCodePendenteProduzirBusinessImpl();
		$fqppdto = $fqppbo->pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $idcampanha, ConstantesVariavel::STATUS_PENDENTE);

		if($fqppdto != NULL && $fqppdto->id == NULL){
			$fqppdto->msgcode = ConstantesMensagem::NAO_EXISTEM_CARIMBOS_NA_FILA_PROCESSAR;
			$fqppdto->msgcodeString = MensagemCache::getInstance()->getMensagem($fqppdto->msgcode);
			return $fqppdto;
		}

		//----------------------------------------------------------------------
		// Verifica se serão criados mais carimbos que o permitido restante
		// para a campanha
		//----------------------------------------------------------------------
		$maxPermitidoFabricar = $dto->maximoCartoes * $dto->maximoSelos - $dto->totalCarimbos;

		if($fqppdto->qtde > $maxPermitidoFabricar) {
			$dto->msgcode = ConstantesMensagem::TENTATIVA_CRIAR_CARIMBOS_ACIMA_LIMITE;
			$dto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($dto->msgcode, 
							[
								ConstantesVariavel::P1 => $fqppdto->qtde,
								ConstantesVariavel::P2 => $maxPermitidoFabricar
							]);
			return $dto;
		}

		//----------------------------------------------------------------------
		// Aqui não há necessidade de calcular qtdes de carimbos, a informação
		// já foi armazenada pelo método criarCarimbosCampanha() em uma etapa
		// anterior
		//----------------------------------------------------------------------
		$totalFabricar = $fqppdto->qtde;
		
		$cqr = new campanhaQrCodeBusinessImpl();
		$date = new DateTime();
		$ts = $date->getTimestamp();
		$parent = sha1($idcampanha . $ts . Util::getCodigo(2048));

		for ($i=0; $i < $totalFabricar; $i++) { 

			$cqrdto = new CampanhaQrCodeDTO();
			$cqrdto->id_campanha = $dto->id;
			$cqrdto->parent = $parent;
			$cqrdto->order = $i + 1;			
			$cqrdto->idusuarioGerador = $id_usuario;
			$cqrdto = $cqr->inserir($daofactory, $cqrdto);
			$parent = $cqrdto->id;

		}

		$cbo = new CampanhaBusinessImpl();
		//$cbo->atualizarTotalCarimbosFabricados($daofactory, $idcampanha, $totalFabricar);
		$cbo->atualizarTotalCarimbosAdicionados($daofactory, $idcampanha, $totalFabricar);

		// Atualiza status da fila de produção
		$fqppbo->atualizarStatus($daofactory, $fqppdto->id, ConstantesVariavel::STATUS_REALIZADO);

		return $dto;
	}


	/**
	 * criarCarimbosCampanha - Realizar a criação de carimbos para uma determinada campanha
	 * de usuário.
	 * A criação do carimbo é parcial, pois temos que TOMAR CUIDADO com o timeout do provedor
	 * no banco de dados.
	 * 
	 * o método cria uma quantidade inicial, definida em VARIAVEL, totalmente operacional. O restante
	 * dos carimbos é encaminhado para uma fila de job em partes, que será criada por outro processo dentro de
	 * uma cron.
	 * 
	 * @param daofactory
	 * @param idcampanha
	 * @param id_usuario
	*/
	public function criarCarimbosCampanha($daofactory, $idcampanha, $id_usuario) 
	{
		$isFracionar = false;

		// Obtem DTO da campanha JCV
		$daocampanha = $daofactory->getCampanhaDAO($daofactory);
		$dto = $daocampanha->loadPK($idcampanha);
		
		//----------------------------------------------------------------------
		// Inserir o maximo de qrcodes validos (carimbos) na Campanha Qr Codes
		// Padrão está demarcado na variavel MAXIMO_QRCODE_CARIMBO_POR_CARTAO 
		//----------------------------------------------------------------------
		$max = $dto->maximoSelos;
		$maxCartoesProduzir = $dto->maximoCartoes;
		$cqr = new campanhaQrCodeBusinessImpl();

		$first = true;
		$date = new DateTime();
		$ts = $date->getTimestamp();
		$parent = sha1($idcampanha . $ts . Util::getCodigo(2048));

		//----------------------------------------------------------------------
		// Define o maximo de cartões que deverá ser produzido de forma
		// não estourar o timeout do servidor de banco de dados no provedor
		// de internet
		//----------------------------------------------------------------------
		$maxCartoesConfig = (int) VariavelHelper::getVariavel(ConstantesVariavel::CRIAR_CARTAO_CARIMBO_LOTE_MAXIMO);

		// Campanha tem um número de cartões muito alto? Maior que a cofniguração?
		if($maxCartoesProduzir > $maxCartoesConfig){
			$maxCartoesProduzir = $maxCartoesConfig;
			$isFracionar = true;
		}

		// Calcula o máximo de carimbos a serem fabricados operacionalmente
		$totalFabricar = $maxCartoesProduzir * $max;

		// calcula o restante que deve ser fabricado de forma fracionada
		$maxCarimbosProduzirFila = $dto->maximoCartoes * $max - $totalFabricar;

		for ($i=0; $i < $totalFabricar; $i++) { 

			$cqrdto = new CampanhaQrCodeDTO();
			$cqrdto->id_campanha = $dto->id;
			$cqrdto->parent = $parent;
			$cqrdto->order = $i + 1;			
			$cqrdto->idusuarioGerador = $id_usuario;
			$cqrdto = $cqr->inserir($daofactory, $cqrdto);
			$parent = $cqrdto->id;

			//----------------------------------------------------------------------
			// como é a primeira campanha atualiza o primeiro carimbo de liberacao
			//----------------------------------------------------------------------
			if ($first){
				$first = false;
				$campbo = new CampanhaBusinessImpl();
				$ret = $campbo->atualizarProximoQrCode($daofactory, $idcampanha, $cqrdto->id);
			}
		}

		$cbo = new CampanhaBusinessImpl();
		$cbo->atualizarStatus($daofactory, $idcampanha, ConstantesVariavel::STATUS_ATIVO);
		$cbo->atualizarTotalCarimbosFabricados($daofactory, $idcampanha, $totalFabricar);

		//----------------------------------------------------------------------
		// Fracionamento de criação de carimbos foi ativado? Então vamos inserir
		// pedido na fila para criação fracionada de carimbos
		//----------------------------------------------------------------------
		if($isFracionar && $maxCarimbosProduzirFila > 0){
			$fqppbo = new FilaQRCodePendenteProduzirBusinessImpl();
			while( $maxCarimbosProduzirFila > 0){
				$fqppdto = new FilaQRCodePendenteProduzirDTO();
				$fqppdto->id_campanha = $idcampanha;
				$fqppdto->id_usuario = $id_usuario;
				$fqppdto->qtde = $maxCartoesConfig * $max;
				
				if($fqppbo->inserir($daofactory, $fqppdto)){
					// Contabiliza controlador
					$maxCarimbosProduzirFila -= $maxCartoesConfig * $max;
				} else {
					break;
				}

			}
		}



		return true;
	}

	public function listarPagina($daofactory, $pag, $qtde)	
	{	
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		return $dao->listPagina($pag, $qtde);
	}

	public function atualizarStatusPorTicket($daofactory, $ticket, $status){
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		return $dao->updateStatusPorTicket($ticket, $status);
	}

	public function atualizarUsuarioGerador($daofactory,$caqrid,$idusuario)
	{
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$ok = $dao->updateUsuarioGeradorQRCode($caqrid, $idusuario);
		if ($ok) {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ATUALIZAR_STATUS_CAMPANHA_QRCODES_FALHA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;

	}

	
	public function atualizarStatusPorCarimbo($daofactory, $carimboqr, $status)
	{
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$ok = $dao->updateStatusPorCarimbo($carimboqr, $status);
		if ($ok) {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ATUALIZAR_STATUS_CAMPANHA_QRCODES_FALHA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;

	}


	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		return $dao->loadPK($id);
	}

	public function inserir($daofactory, $dto)
	{ 
		$ok = false;

		// Monta a regra do QRCode de cada carimbo da respectiva campanha
		$date = new DateTime();
		$ts = $date->getTimestamp();
		$carimbotmp = sha1($dto->id_campanha . $ts . Util::getCodigo(2048));

		$dto->id = sha1($dto->id_campanha . $ts . Util::getCodigo(2048));

		//coloca os identificadores de qrcode de captura pelo celular e impressão
		$dto->qrcodecarimbo = '01' . $carimbotmp;
		$dto->qrcodecarimboImpressao = '02' . $carimbotmp;
		$dto->ticket = Util::geraCpf(); //Gera um cpf fake como codigo;
		$dto->status = ConstantesVariavel::STATUS_ATIVO;

		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);

		//$retorno = new DTOPadrao();
		if ($dao->insert($dto)) {
			$ok = true;
		}

		if ($ok) {
			$dto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
		} else {
			$dto->msgcode = ConstantesMensagem::ERRO_INESPERADO;
			$dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
		}

		return $dto;
	}


/**
*
* listarCampanhaQrCodeIdCampanhaPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaQrCodeDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

	public function listarCampanhaQrCodeIdCampanhaPorStatus($daofactory, $idcampanha, $status, $pag, $qtde, $coluna, $ordem)
	{   
		$retorno = new DTOPaginacao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		$retorno->pagina = $pag;
		$retorno->itensPorPagina = ($qtde == 0 
		? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
		: $qtde);
		$retorno->totalPaginas = ceil($dao->countCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status) / $retorno->itensPorPagina);

		if($pag > $retorno->totalPaginas) {
			$retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}
		$retorno->lst = $dao->listCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

		return $retorno;
	}


}
?>
