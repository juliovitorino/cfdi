<?php  

// importar dependencias
require_once 'cartaoBusiness.php';
require_once 'cartaoBusinessImpl.php';
require_once 'cartaoFullDTO.php';

require_once '../cfdi/cfdiBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../selocuringa/seloCuringaDAO.php';

/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 
 
 
/**
 * CartaoBusinessImpl - Implementação da classe de negocio
 */
class CartaoBusinessImpl implements CartaoBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function deletar($daofactory, $dto)	{	}
	public function atualizar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}

	public function listarPagina($daofactory, $pag, $qtde)	
	{	
		$dao = $daofactory->getCartaoDAO($daofactory);
		return $dao->listPagina($pag, $qtde);
	}
	

	public function moverCartaoInteiroParaOutroUsuario($daofactory, $idusuarioDono, $idusuarioDestino, $idCartao)
	{
		// retorno padrão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// busca dados do usuario dono e usuario destino
		$usuabo = new UsuarioBusinessImpl();
		$usuarioDonoDTO = $usuabo->carregarPorID($daofactory, $idusuarioDono);
		$usuarioDestinoDTO = $usuabo->carregarPorID($daofactory, $idusuarioDestino);

		$cartaobo = new CartaoBusinessImpl();
		$cartaodto = $cartaobo->carregarPorID($daofactory, $idCartao); 

		// busca dados do cartão em aberto

		//----------------------------------
		// verificações de regras de negócio
		//----------------------------------

		// cartão inexistente por qualquer motivo, falha
		// usuario dono == usuariodestino, falha
		// usuariodono != cartaodto->idusuario, falha
		// usuariodestino status != A, falha
		// usuariodestino tem um cartão ativo em aberto, falha
		// status cartão acima de status "resgatado", falha

		//------------------------------------------------------------------------
		// todas as condições estão satisfatorias. move o cartão para outra pessoa
		//------------------------------------------------------------------------
		
		// trocar o usua_id do cartão atual do usuario atual para o novo destinatario
		$cartdao = $daofactory->getCartaoDAO();
		if( ! $cartdao->updateMoverCartaoInteiroParaOutroUsuario($idusuarioDestino, $idCartao)) 
		{
			// emite erro
			
		}
		// pega todos os carimbos do cartão e troca do dono na CFDI


		return $retorno;

	}

	public function pesquisarPorCampanhaUsuarioStatus($daofactory, $idusuario, $idcampanha, $status)
	{ 
		$dao = $daofactory->getCartaoDAO($daofactory);
		$retorno = $dao->loadCampanhaUsuarioStatus($idusuario, $idcampanha, $status);

		if($retorno->id != null){
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

			$campbo = new CampanhaBusinessImpl();
			$campdto = $campbo->carregarPorID($daofactory, $retorno->id_campanha);

			if($retorno->contador >= $campdto->maximoSelos){
					$usbo = new UsuarioBusinessImpl();
				$usdto = $usbo->carregarPorID($daofactory, $retorno->id_usuario);

				$campbo = new CampanhaBusinessImpl();
				$campdto = $campbo->carregarPorID($daofactory, $retorno->id_campanha);

				$retorno->msgcode = ConstantesMensagem::CARTAO_TOTALMENTE_COMPLETO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, 
							[ 	ConstantesVariavel::P1 => $usdto->apelido,
								ConstantesVariavel::P2 => $campdto->nome
							]);
			}
		}

		return $retorno;
	}

	public function listarCartoesFullInfoFavoritos($daofactory, $idusuario, $status)
	{

		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listAllCartaoFavoritosPorUsuarioStatus($idusuario, $status);

		$lstretorno = [];
		if(count($lst) > 0) {
			foreach ($lst as $key => $dtocartao) {
				array_push($lstretorno, $this->carregarCartaoFull($daofactory, $dtocartao->id, $idusuario));
			}
		}

		//var_dump($lst);
		return $lstretorno;


	}

	public function listarAllCartaoComentarios($daofactory, $idcampanha, $isPositivo, $qtdeComentarios=0 )
	{
		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios);
		$lstretorno = [];
		if(count($lst) > 0) {
			foreach ($lst as $key => $dtocartao) {
				array_push($lstretorno, $this->carregarCartaoFull($daofactory, $dtocartao->id, $dtocartao->id_usuario));
			}
		}

		return $lstretorno;
	}

	public function listarCartoesFullInfo10M($daofactory, $idusuario, $status)
	{
		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listAllCartaoPorUsuarioStatus10M($idusuario, $status);
		$lstretorno = [];
		if(count($lst) > 0) {
			foreach ($lst as $key => $dtocartao) {
				array_push($lstretorno, $this->carregarCartaoFull($daofactory, $dtocartao->id, $idusuario));
			}
		}

		return $lstretorno;


	}


	public function listarCartoesFullInfo($daofactory, $idusuario, $status)
	{
		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listAllCartaoPorUsuarioStatus($idusuario, $status);
		$lstretorno = [];
		if(count($lst) > 0) {
			foreach ($lst as $key => $dtocartao) {
				array_push($lstretorno, $this->carregarCartaoFull($daofactory, $dtocartao->id, $idusuario));
			}
		}

		return $lstretorno;


	}

	public function listarCartoesFullInfoProcessoResgate($daofactory, $idusuario)
	{

		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listAllCartaoPorUsuarioProcessoResgate($idusuario);

		$lstretorno = [];
		if(count($lst) > 0) {
			foreach ($lst as $key => $dtocartao) {
				array_push($lstretorno, $this->carregarCartaoFull($daofactory, $dtocartao->id, $idusuario));
			}
		}

		return $lstretorno;

	}
	
	public function contarParticipantesCampanha($daofactory, $id_campanha)
	{ 
		$dao = $daofactory->getCartaoDAO($daofactory);
		return $dao->countParticipantesCampanha($id_campanha);
	}

	public function listarParticipantesCampanha($daofactory, $id_campanha, $pag, $qtde)
	{ 
		$retorno = [];
		$dao = $daofactory->getCartaoDAO($daofactory);
		$lst = $dao->listParticipantesCampanha($id_campanha, $pag, $qtde);
		foreach ($lst as $key => $cartaodto) {
			array_push($retorno, $this->carregarCartaoFull($daofactory, $cartaodto->id, $cartaodto->id_usuario));
		}
		return $retorno;
	}


	public function carregarCartaoFull($daofactory, $id, $id_usuario){
		$fulldto = new CartaoFullDTO();
		$fulldto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
	
		$dtocartao = $this->carregarPorID($daofactory, $id);
		if($dtocartao->id != null){

			if($dtocartao->id_usuario != $id_usuario){
				$fulldto->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
				$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
			} else {
				$fulldto->cartao = $dtocartao;
				$lstcarimbos = explode(';',$dtocartao->carimbos);
				foreach ($lstcarimbos as $key => $value) {
					$dtocarimbo = new CfdiDTO();

					$cfdibo = new CfdiBusinessImpl();
					$dtocarimbo = $cfdibo->carregarPorCarimbo($daofactory, $value);
					array_push($fulldto->cartao->lstcarimbos, $dtocarimbo);
				}
	
				// Obtem dados da campanha
				$dao = $daofactory->getCampanhaDAO($daofactory);
				$fulldto->campanha = $dao->loadPK($dtocartao->id_campanha);
	
				// Obtem dados da usuário e do dono da campanha (parceiro)
				$dao = $daofactory->getUsuarioDAO($daofactory);
				$fulldto->usuario = $dao->loadPK($dtocartao->id_usuario);
				$fulldto->parceiro = $dao->loadPK($fulldto->campanha->id_usuario);

				// obtem dados do selo curinga
				if($dtocartao->idselocuringa != 0) {
					$dao = $daofactory->getSeloCuringaDAO($daofactory);
					$fulldto->cartao->selocuringa = $dao->loadPK($dtocartao->idselocuringa);
				}
//var_dump($fulldto);

			}
		} else {
			$fulldto->msgcode = ConstantesMensagem::CARTAO_INVALIDO;
			$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
		}

		return $fulldto;
	}
	
	public function carregarCartaoFullCarimbo($daofactory, $carimbo, $id_usuario, $status)
	{
		$fulldto = new CartaoFullDTO();
		$fulldto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
	
		$dao = $daofactory->getCfdiDAO($daofactory);
		$cfdidto = $dao->loadCarimbo($carimbo);

		if($cfdidto->id != null){

			if($cfdidto->id_fiel != $id_usuario){
				$fulldto->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
				$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($fulldto->msgcode, [
					ConstantesVariavel::P1 => $cfdidto->id_fiel
				]);
			} else {

				$dao = $daofactory->getCartaoDAO($daofactory);
				$dtocartao = $dao->loadCampanhaUsuarioStatus($cfdidto->id_fiel, $cfdidto->id_campanha, $status);
				
				if($dtocartao->id != null){

					if( strpos($dtocartao->carimbos,$carimbo) !== false){
						$fulldto->cartao = $dtocartao;
						$lstcarimbos = explode(';',$dtocartao->carimbos);
						foreach ($lstcarimbos as $key => $value) {
							//$dtocarimbo = new CfdiDTO();
							//$dao = $daofactory->getCfdiDAO($daofactory);
							//$dtocarimbo = $dao->loadCarimbo($value);
							
							$bocarimbo = new CfdiBusinessImpl(); 
							$dtocarimbo = $bocarimbo->carregarPorCarimbo($daofactory, $value);
							
							array_push($fulldto->cartao->lstcarimbos, $dtocarimbo);
						}
			
						$dao = $daofactory->getCampanhaDAO($daofactory);
						$fulldto->campanha = $dao->loadPK($dtocartao->id_campanha);
			
						$dao = $daofactory->getUsuarioDAO($daofactory);
						$fulldto->usuario = $dao->loadPK($dtocartao->id_usuario);
						$fulldto->parceiro = $dao->loadPK($fulldto->campanha->id_usuario);
					} else {
						$fulldto->msgcode = ConstantesMensagem::CARIMBO_NAO_REGISTRADO_NO_CARTAO;
						$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($fulldto->msgcode, [
							ConstantesVariavel::P1 => $carimbo,
							ConstantesVariavel::P2 => $dtocartao->id,
							ConstantesVariavel::P3 => $dtocartao->id_campanha,
							ConstantesVariavel::P4 => $dtocartao->id_usuario
						]);
					}

				} else {
					$fulldto->msgcode = ConstantesMensagem::CARTAO_INVALIDO;
					$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
				}

			}
		} else {
			$fulldto->msgcode = ConstantesMensagem::TICKET_INVALIDO;
			$fulldto->msgcodeString = MensagemCache::getInstance()->getMensagem($fulldto->msgcode);
		}

		return $fulldto;
	}


	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getCartaoDAO($daofactory);
		return $dao->loadPK($id);
	}

	public function carregarPorHashResgate($daofactory, $hash)
	{ 
		$dao = $daofactory->getCartaoDAO($daofactory);
		$retorno = $dao->loadHashResgate($hash);
		if ($retorno != null && $retorno->id != null) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::CARTAO_PARA_RESGATE_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function incrementarContador($daofactory, $id, $qrcodecarimbo)
	{
		$dao = $daofactory->getCartaoDAO($daofactory);
		$updateok = true;

		// resposta padrão
		$retorno = new DTOPadrao();

		if($dao->incrementarContador($id, $qrcodecarimbo)){	
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function atualizarLike($daofactory, $id, $idusuario)
	{
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$dao = $daofactory->getCartaoDAO($daofactory);
		$cartaodto = $this->carregarPorID($daofactory, $id);
		if($cartaodto == null || $cartaodto->id == null) {
			$retorno->msgcode = ConstantesMensagem::CARTAO_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}
		if($cartaodto->id_usuario != $idusuario) {
			$cartaodto->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
			$cartaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($cartaodto->msgcode);
			return $cartaodto;
		}

		$isLike = $cartaodto->like == 'S' ? false : true;
		$dao = $daofactory->getCartaoDAO($daofactory);

		if(!$dao->updateLike($id, $isLike)) {
			$cartaodto->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$cartaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($cartaodto->msgcode);
			return $cartaodto;
		}

		$campbo = new CampanhaBusinessImpl();
		$retcamp = $campbo->atualizarTotalLike($daofactory, $cartaodto->id_campanha, $cartaodto->id_usuario, $isLike);

		if($retcamp->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			$cartaodto->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$cartaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($cartaodto->msgcode);
			return $cartaodto;
		}

		return $retorno;

	}

	public function atualizarFavoritos($daofactory, $idcartao, $idusuario)
	{
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$dao = $daofactory->getCartaoDAO($daofactory);
		$cartaodto = $this->carregarPorID($daofactory, $idcartao);
		if($cartaodto == null || $cartaodto->id == null) {
			$retorno->msgcode = ConstantesMensagem::CARTAO_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}
		if($cartaodto->id_usuario != $idusuario) {
			$cartaodto->msgcode = ConstantesMensagem::CARTAO_PERTENCE_OUTRO_USUARIO;
			$cartaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($cartaodto->msgcode);
			return $cartaodto;
		}

		$isFavorito = $cartaodto->favorito == 'S' ? false : true;
		$dao = $daofactory->getCartaoDAO($daofactory);

		if(!$dao->updateFavorito($idcartao, $isFavorito)) {
			$cartaodto->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$cartaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($cartaodto->msgcode);
			return $cartaodto;
		}

		return $retorno;

	}

	public function atualizarAvaliacao($daofactory, $id, $rating='5', $comentario='')
	{
		$dao = $daofactory->getCartaoDAO($daofactory);

		$retorno = $this->carregarPorID($daofactory, $id);
		if($retorno->id != null) {			
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

			if($comentario == null){
				$comentario = '';
			}

			if($retorno->rating != '0'){
				$retorno->msgcode = ConstantesMensagem::CARTAO_CAMPANHA_JA_FOI_AVALIADO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				return $retorno;
			}

			if(! $dao->updateRatingComentario($id, $rating, $comentario)){	
				$retorno->msgcode = ConstantesMensagem::ERRO_AO_ATUALIZAR_REGISTRO_DE_RESGATE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
				return $retorno;
			}
		}
		
		// Obtem o texto da mensagem em razão do código de retorno
		return $retorno;
	}

		
	public function atualizarStatus($daofactory, $id, $status)
	{
		$dao = $daofactory->getCartaoDAO($daofactory);

		// obtem o status atual da cfdi
		$retorno = $this->carregarPorID($daofactory, $id);
		if($retorno->id != null) {
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			if(! $dao->updateStatus($id, $status)){	
				$retorno->msgcode = ConstantesMensagem::ERRO_AO_ATUALIZAR_REGISTRO_DE_RESGATE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				// Atualiza o follow up de datas
				if ($status == ConstantesVariavel::STATUS_VALIDAR_COMPLETOU) {
					$ret = $dao->updateDataCartaoCompletou($id);
				} else if($status == ConstantesVariavel::STATUS_VALIDAR_RESGATOU){
					$ret = $dao->updateDataCartaoValidou($id);
				} else if($status == ConstantesVariavel::STATUS_VALIDAR_ENTREGOU){
					$ret = $dao->updateDataCartaoEntregou($id);
				} else if($status == ConstantesVariavel::STATUS_VALIDAR_RECEBEU){
					$ret = $dao->updateDataCartaoRecebeuRecompensa($id);
				}
			}
		}
		
		// Obtem o texto da mensagem em razão do código de retorno
		return $retorno;
	}

	public function inserir($daofactory, $dto)
	{ 
		$ok = false;

		// Monta a regra do QRCode da Cartao
		$dto->status = ConstantesVariavel::STATUS_ATIVO;
		$dto->hashresgate = sha1(Util::getCodigo(1024));
		$dao = $daofactory->getCartaoDAO($daofactory);

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
