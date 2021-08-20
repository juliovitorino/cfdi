<?php  
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
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

// importar dependencias
require_once 'campanhaBusiness.php';
require_once 'carimboDTO.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';
require_once '../campanhaqrcode/campanhaQrCodeBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/VariavelHelper.php';
require_once '../campanhacashback/CampanhaCashbackHelper.php';
require_once '../usuarioautorizador/UsuarioAutorizadorBusinessImpl.php';
require_once '../usuarioavaliacao/UsuarioAvaliacaoBusinessImpl.php';
require_once '../permissao/PermissaoHelper.php';
require_once '../cartaopedido/CartaoPedidoBusinessImpl.php';
require_once '../cartaopedido/CartaoPedidoDTO.php';
require_once '../plano/ConstantesPlano.php';
require_once '../registroindicacao/RegistroIndicacaoBusinessImpl.php';
require_once '../campanhacashbackcc/CampanhaCashbackCCBusinessImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';
require_once '../usuarios/UsuarioHelper.php';
require_once '../fundoparticipacaoglobal/FundoParticipacaoGlobalBusinessImpl.php';


/**
 * CampanhaBusinessImpl - Implementação da classe de negocio
 */
class CampanhaBusinessImpl implements CampanhaBusiness
{
	
	function __construct()	{	}

	public function carregar($daofactory, $dto)	{	}
	public function listarTudo($daofactory)	{	}

	public function atualizarTotalCarimbosAdicionados($daofactory, $id_campanha, $qtde)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($id_campanha);

		if($retorno->id != null){
			if($dao->updateTotalCarimbosAdicionados($id_campanha, $qtde)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function atualizarTotalCartoesAdicionados($daofactory, $id_campanha, $qtde)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($id_campanha);

		if($retorno->id != null){
			if($dao->updateTotalCartoesAdicionados($id_campanha, $qtde)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function adicionarMaisCartoes($daofactory, $id_campanha, $id_usuario)
	{
//var_dump($id_campanha);
//var_dump($id_usuario);
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		// -----------------------------------------------------------------------------
		// Verifica existencia da campanha e do usuário
		// -----------------------------------------------------------------------------
		$campdto = $this->carregarPorID($daofactory, $id_campanha);
		if($campdto == NULL || $campdto->id == NULL){
			$retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;	
		}

		if(!UsuarioHelper::isUsuarioValido($daofactory, $id_usuario)){
			$retorno->msgcode = ConstantesMensagem::USUARIO_NAO_ENCONTRADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;	
		}
		$usuadto = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

		// -----------------------------------------------------------------------------
		// Verifica se o usuário é o dono da campanha
		// -----------------------------------------------------------------------------
		if($campdto->id_usuario != $id_usuario){
			$retorno->msgcode = ConstantesMensagem::VOCE_NAO_PATROCINA_ESTA_CAMPANHA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;	
		}

		// -----------------------------------------------------------------------------
		// Verifica o Status da Campanha FILA.
		// -----------------------------------------------------------------------------
		if($campdto->status == ConstantesVariavel::STATUS_FILA){
			$retorno->msgcode = ConstantesMensagem::CAMPANHA_NA_FILA_PARA_CRIACAO_CARIMBOS;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
				ConstantesVariavel::P1 => $campdto->nome,
			]);
			return $retorno;	
		}

		// -----------------------------------------------------------------------------
		// Verifica inconsistência de carimbos e carimbados com status ATIVO
		// -----------------------------------------------------------------------------
		if($campdto->status == ConstantesVariavel::STATUS_ATIVO &&
			$campdto->totalCarimbos == 0 &&
			$campdto->totalCarimbados == 0
		){
			$retorno->msgcode = ConstantesMensagem::CAMPANHA_COM_GERENCIADOR_CARIMBOS_INCONSISTENTE;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
				ConstantesVariavel::P1 => $campdto->nome,
			]);
			return $retorno;	
		}

		// -----------------------------------------------------------------------------
		// Verifica se já tem pedido PENDENTE na CAPE para ser realizado
		// -----------------------------------------------------------------------------
		$capebo = new CartaoPedidoBusinessImpl();
		$capedto = $capebo->PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $campdto->id, ConstantesVariavel::STATUS_PENDENTE);
//var_dump($capedto)		;
		if($capedto != NULL && $capedto->id != NULL) {
			$capedto->msgcode = ConstantesMensagem::CAMPANHA_COM_CARIMBOS_ADICIONAIS_NA_FILA;
			$capedto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($capedto->msgcode,[
				ConstantesVariavel::P1 => $campdto->nome,
				ConstantesVariavel::P2 => $capedto->qtde,
			]);
			return $capedto;	

		}

		// -----------------------------------------------------------------------------
		// Verifica se já tem pedido TRABALHANDO (W) na CAPE para ser realizado
		// -----------------------------------------------------------------------------
		$capedto = $capebo->PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $campdto->id, ConstantesVariavel::STATUS_TRABALHANDO);
//var_dump($capedto)		;
		if($capedto != NULL && $capedto->id != NULL) {
			$capedto->msgcode = ConstantesMensagem::CAMPANHA_COM_CARIMBOS_PRODUZINDO;
			$capedto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($capedto->msgcode,[
				ConstantesVariavel::P1 => $campdto->nome,
				ConstantesVariavel::P2 => $capedto->qtde,
			]);
			return $capedto;	

		}

		// -----------------------------------------------------------------------------
		// Verifica permissao PERM_ADICIONAR_CARTOES_CAMPANHA de acordo com 
		// plano do usuário registrado mais recente e ATIVO
		// -----------------------------------------------------------------------------
		$permdto = PermissaoHelper::verificarPermissao($daofactory, $usuadto->id, ConstantesPlano::PERM_ADICIONAR_CARTOES_CAMPANHA);
//var_dump($permdto);
		if ($permdto->msgcode == ConstantesMensagem::PERMISSAO_NEGADA_MAX_PERMITIDO_EXCEDIDO) {

			//desabilitar esse retorno pq temos que verificar o status do pedido
			//$retorno->msgcode = ConstantesMensagem::DESEJA_REALIZAR_A_COMPRA_DE_CARTOES;
			//$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
			//	ConstantesVariavel::P1 => $usuadto->apelido,
			//]);

			return $retorno;	

			// -----------------------------------------------------------------------------
			// 1) se NÃO tiver essa permissão no plano dele, verificar se tem pedido LIBERADO
			// na CARTAO_PEDIDO
			// -----------------------------------------------------------------------------
			
		}

		// -----------------------------------------------------------------------------
		// 2) se tiver essa permissão no plano dele, devemos verificar se os cartões 
		// realmente já acabaram. Se não acabou, o parceiro ainda não pode criar.
		// -----------------------------------------------------------------------------
		if($campdto->status == ConstantesVariavel::STATUS_ATIVO &&
			$campdto->maximoCartoes > $campdto->contadorCartoes
		){
			$retorno->msgcode = ConstantesMensagem::AINDA_TEM_CARTOES_LIVRES;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
				ConstantesVariavel::P1 => $campdto->nome,
				ConstantesVariavel::P2 => ($campdto->maximoCartoes - $campdto->contadorCartoes),
			]);
			return $retorno;	
		}

		// -----------------------------------------------------------------------------
		// Se permissao == MSG-0001
		// a. inserir registro na CAPE status default PENDENTE
		// b. atualizar status na CAPE para WORKING
		// c. Muda o Status da Campanha para FILA
		// d. Avisa o usuário que o procedimento foi realizado e dita próximas instruções
		// ------------------------------------------------------------------------------
		if ($permdto->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			$capedto = new CartaoPedidoDTO();
			$capedto->id_campanha = $campdto->id;
			$capedto->descpedido = "Adicionar Autorizado FUNCAO_ADICIONAR_CARTOES_CAMPANHA";
			$capedto->hashTransacao = sha1(Util::getCodigo(2048) . Util::getNow());
			$capedto->qtde = (double) $permdto->qtdepermitida;
			$capedto->selos = $campdto->maximoSelos;
			$capedto->vlrPedido = 0.00;
			$capedto->dataAutorizacao = Util::getNow();
//var_dump($capedto)			;
			if(!$capebo->inserir($daofactory, $capedto)){
				$capedto->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
				$capedto->msgcodeString = MensagemCache::getInstance()->getMensagem($capedto->msgcode);
				return $capedto;
						
			}

			// Recupera registro para atualização de Status por PK
			$capedto = $capebo->PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $campdto->id, ConstantesVariavel::STATUS_PENDENTE);
			$capebo->atualizarStatus($daofactory, $capedto->id, ConstantesVariavel::STATUS_TRABALHANDO);

			// Muda status da Campanha para WORKING, tenho que ir pelo DAO para Bypass de Regras de Status
			$campdao = $daofactory->getCampanhaDAO($daofactory);
			$campdao->updateStatus($campdto->id, ConstantesVariavel::STATUS_TRABALHANDO);

			// -----------------------------------------------------------------
			// Cria os carimbos adicionais pra ser usado na campanha
			// -----------------------------------------------------------------
			$cqrbo = new campanhaQrCodeBusinessImpl();
			if(!$cqrbo->adicionarMaisCarimbosCampanha($daofactory, $capedto->id)){
				$capedto->msgcode = ConstantesMensagem::CAMPANHA_ERRO_CRIAR_CARIMBOS_ADICIONAIS;
				$capedto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($capedto->msgcode,[
					ConstantesVariavel::P1 => $campdto->nome,
					ConstantesVariavel::P2 => $capedto->qtde,
				]);
				return $retorno;	
				}
		}

		return $retorno;
	}


	public function incrementarContadorCartaoDistribuido($daofactory, $id_campanha)
	{
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$dao = $daofactory->getCampanhaDAO($daofactory);
		if(!$dao->updateTotalCartoesDistribuidos($id_campanha)){
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		return $retorno;

	}
	
	public function atualizar($daofactory, $dto)	
	{	

		// retorno default
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		$ok = true;

		// Verifica o usuário no DTO
		$usuabo = new UsuarioBusinessImpl();
		$usuadto = $usuabo->carregarPorID($daofactory, $dto->id_usuario);

		if($usuadto == null || $usuadto->id == null){
			$usuadto->msgcode = ConstantesMensagem::USUARIO_INVALIDO_PARA_CAMPANHA;
			$usuadto->msgcodeString = MensagemCache::getInstance()->getMensagem($usuadto->msgcode);
			return $usuadto;
		}
		// Verifica a situação atual da campanha antes de atualizar
		$dtocheck = $this->carregarPorID($daofactory, $dto->id);

		if($dtocheck->id != null){
			if(!$dtocheck->permiteAlterarMaximoSelos && $dtocheck->maximoSelos != $dto->maximoSelos)
			{
				$dtocheck->msgcode = ConstantesMensagem::CAMPANHA_NAO_PERMITE_TROCA_DE_SELOS;
				$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($dtocheck->msgcode, [
					ConstantesVariavel::P1 => $dtocheck->nome,
					ConstantesVariavel::P2 => $dtocheck->maximoSelos,
				]);
				return $dtocheck;
			}

			// Usuário COMUM é negado a troca de quantidade de selos
			if(
				$usuadto->tipoConta == ConstantesVariavel::CONTA_USUARIO_COMUM && 
				$dtocheck->maximoSelos != $dto->maximoSelos
			)
			{
				$dtocheck->msgcode = ConstantesMensagem::CONTA_GRATUITA_NAO_PERMITE_TROCA_DE_SELOS;
				$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagem($dtocheck->msgcode);
				return $dtocheck;
			}

			// Verifica se permite alteração de selos, porém a conta do usuário NÃO PODE ser gratuita
			if($dtocheck->permiteAlterarMaximoSelos){
				$sbi = new PlanoUsuarioBusinessImpl();
				$plusid = $sbi->carregarPlanoUsuarioPorStatus($daofactory, $usuadto->id, ConstantesVariavel::STATUS_ATIVO);
				$plusdto = $sbi->carregarPorID($daofactory, $plusid->id);

				//var_dump($plusdto);
				if($plusdto->planoid == VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO) && $dto->maximoSelos != 10 ){
					$dtocheck->msgcode = ConstantesMensagem::CONTA_GRATUITA_NAO_PERMITE_TROCA_DE_SELOS;
					$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($dtocheck->msgcode, [
						ConstantesVariavel::P1 => $dtocheck->nome,
						ConstantesVariavel::P2 => $dtocheck->maximoSelos,
					]);
					return $dtocheck;

				}
	
			}

			if($dtocheck->status == ConstantesVariavel::STATUS_ATIVO && $dtocheck->dataInicio != $dto->dataInicio){
				$dtocheck->msgcode = ConstantesMensagem::CAMPANHA_EM_ANDAMENTO_DATA_INICIO_TERMINO_NEGADA;
				$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($dtocheck->msgcode, [
					ConstantesVariavel::P1 => $dtocheck->nome,
					ConstantesVariavel::P2 => $dtocheck->dataInicio,
					ConstantesVariavel::P3 => $dtocheck->dataTermino,
				]);
				return $dtocheck;

			}
			if($dtocheck->status == ConstantesVariavel::STATUS_ATIVO && $dtocheck->dataTermino != $dto->dataTermino){
				$dtocheck->msgcode = ConstantesMensagem::CAMPANHA_EM_ANDAMENTO_DATA_INICIO_TERMINO_NEGADA;
				$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($dtocheck->msgcode, [
					ConstantesVariavel::P1 => $dtocheck->nome,
					ConstantesVariavel::P2 => $dtocheck->dataInicio,
					ConstantesVariavel::P3 => $dtocheck->dataTermino,
				]);
				return $dtocheck;

			}
			if($dtocheck->id_usuario != $dto->id_usuario){
				$dtocheck->msgcode = ConstantesMensagem::CAMPANHA_PERTENCE_OUTRO_PATROCINADOR;
				$dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagem($dtocheck->msgcode);
				return $dtocheck;
			}

		} else {
			$ok = false;
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}
		if($ok){
			$dao = $daofactory->getCampanhaDAO($daofactory);
			if(!$dao->update($dto)){
				$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
	
			}
			
		}

		// retorna situação
		return $retorno;

	}
	
	public function deletar($daofactory, $dto)	
	{	
		$dao = $daofactory->getCampanhaDAO($daofactory);
		return $dao->delete($dto);
	}

	public function listarCampanhasPorStatus($daofactory, $status)
	{	
		$dao = $daofactory->getCampanhaDAO($daofactory);
		return $dao->listCampanhasStatus($status);
	}

	public function listarCampanhasUsuarioStatus($daofactory,$id_usuario, $status)
	{	
		$dao = $daofactory->getCampanhaDAO($daofactory);
		return $dao->listCampanhasUsuarioStatus($id_usuario, $status);
	}

	public function listarCampanhasUsuario($daofactory, $id_usuario)
	{	
		// Busca lista de campanhas do próprio usuário
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$lstcamp = $dao->listCampanhasUsuario($id_usuario);
//var_dump($lstcamp);

		// Busca lista de campanhas que o usuário FOI AUTORIZADO por um terceiro
		$usaubo = new UsuarioAutorizadorBusinessImpl();
		$lstautorizados = $usaubo->listarUsuarioCarimbador($daofactory, $id_usuario);
//var_dump($lstautorizados);

		// Devolve um Array<CampanhaDTO>
		$lst = array();
		if(count($lstcamp) > 0){
			foreach ($lstcamp as $key => $campdto) {
				$lst[] = $campdto;
				# code...
			}
		}
		if(count($lstautorizados->lst) > 0){
			foreach ($lstautorizados->lst as $key => $usaudto) {
//var_dump($this->carregarPorID($daofactory, $usaudto->id_campanha));
				$lst[] = $this->carregarPorID($daofactory, $usaudto->id_campanha);
			}
		}
//var_dump($lst);
		// Monta um array de retorno com as campanhas
		return $lst;

	}

	public function listarCampanhasParticipantes($daofactory, $id_campanha, $id_usuario, $pag)
	{	
		$retorno = new DTOPaginacao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		$cartaobo = new CartaoBusinessImpl();
		$retorno->pagina = $pag;
		$retorno->itensPorPagina = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT);
		$retorno->totalPaginas = ceil($cartaobo->contarParticipantesCampanha($daofactory, $id_campanha) / $retorno->itensPorPagina);

		if($pag > $retorno->totalPaginas) {
			$retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}
		$retorno-> lst = $cartaobo->listarParticipantesCampanha($daofactory, $id_campanha, $pag, $retorno->itensPorPagina);
		return $retorno;
	}



	public function listarPagina($daofactory, $pag, $qtde)	
	{	
		$dao = $daofactory->getCampanhaDAO($daofactory);
		return $dao->listPagina($pag, $qtde);
	}

	public function carregarPorID($daofactory, $id)
	{ 
		$dao = $daofactory->getCampanhaDAO($daofactory);
		return $dao->loadPK($id);
	}

	private function isTemCarimboLivre($daofactory, $idcampanha)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);
		$ok = false;

		if($retorno->id != null){
			$ok = ($retorno->totalCarimbos - $retorno->totalCarimbados) > 0;
		}

		return $ok;
	}

	private function getCarimboLivreValido($daofactory, $caqrid, $parent=false)
	{

		//var_dump($caqrid);

		$carimbodto = new CarimboDTO();
		$retorno = new CampanhaQrCodeDTO();
		$dao = $daofactory->getCampanhaQrCodeDAO($daofactory);
		if (!$parent){
			$retorno = $dao->loadPK($caqrid);
		} else {
			$retorno = $dao->loadParent($caqrid);
		}

		if($retorno != null && $retorno->id != null){
			if($retorno->status == ConstantesVariavel::STATUS_ATIVO){
				$carimbodto->id = $retorno->id;
				$carimbodto->carimbo = $retorno->qrcodecarimbo;
				$carimbodto->ticket = $retorno->ticket;
				$carimbodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagem($carimbodto->msgcode);
			} else {
				return $this->getCarimboLivreValido($daofactory, $retorno->id, true);
			}

		} else {
			$carimbodto->msgcode = ConstantesMensagem::ERRO_SEQUENCIAL_DE_CARIMBO_INVALIDO;
			$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($carimbodto->msgcode, 
			[
				ConstantesVariavel::P1 => $caqrid
			]);

		}
		return $carimbodto;
	}


	public function getCarimboLivre($daofactory, $idcampanha, $idusuario)
	{

		$ok = false;
		$carimbodto = new CarimboDTO();
		$carimbodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;

		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		// Verifica se o usuário é o dono da campanha ou se ele tem autorização do dono da campanha
		if($idusuario != $retorno->id_usuario){
			$usaubo = new UsuarioAutorizadorBusinessImpl();
			$usaudto = $usaubo->PesquisarMaxPKAtivoId_UsuarioCarimbadorPorStatus($daofactory,$idusuario,$retorno->id,ConstantesVariavel::STATUS_ATIVO);
			if($usaudto->id != NULL){

				// Se for autorizado temporario, vamos verificar o horário
				if($usaudto->tipo == ConstantesVariavel::AUTORIZADOR_TEMPORARIO){
					// Usar função strtotime() para converter a data em inteiro longo (trimestamp)
					$agora = strtotime(Util::getNow()); 
					$dateTimestamp2 = strtotime(Util::DMYHMiS_to_MySQLDate($usaudto->dataInicio)); 

					// Se a data de hoje for anterior, estamos carimbando antes do prazo inicial - Negar Autorização
					if ($agora < $dateTimestamp2) {
						$carimbodto->msgcode = ConstantesMensagem::PERMISSAO_NEGADA_GERAR_CARIMBO_ANTES_PRAZO;
						$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($carimbodto->msgcode,[
							ConstantesVariavel::P1 => $usaudto->dataInicio
						]);
						return $carimbodto;
					}

					$dateTimestamp2 = strtotime(Util::DMYHMiS_to_MySQLDate($usaudto->dataTermino)); 
										
					// Se a data de hoje for posterior, estamos carimbando depois do prazo inicial - Negar Autorização
					if ($agora > $dateTimestamp2) {
						$carimbodto->msgcode = ConstantesMensagem::PERMISSAO_NEGADA_GERAR_CARIMBO_FIM_PRAZO;
						$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($carimbodto->msgcode,[
							ConstantesVariavel::P1 => $usaudto->dataTermino
						]);
						return $carimbodto;
					}

				}
			} else {
				$carimbodto->msgcode = ConstantesMensagem::PERMISSAO_NEGADA_GERAR_CARIMBO;
				$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagem($carimbodto->msgcode);
				return $carimbodto;

			}
		}

		
		if ($this->isTemCarimboLivre($daofactory, $idcampanha)){
			
			if($retorno->id != null){
				while ($carimbodto->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {

					$caqrid = $retorno->proximoQrCode;
					$caqrbo = new CampanhaQrCodeBusinessImpl();
					$ret = $caqrbo->atualizarUsuarioGerador($daofactory,$caqrid,$idusuario);
					$carimbodto = $this->getCarimboLivreValido($daofactory, $caqrid);
/*var_dump($caqrid);
var_dump($this->isTemCarimboLivre($daofactory, $idcampanha) );
var_dump($carimbodto);*/
					
					//Chegou ao final da lista encadeada?
					if (($caqrid == null) || 
						($this->isTemCarimboLivre($daofactory, $idcampanha) &&
						$carimbodto->msgcode == ConstantesMensagem::ERRO_SEQUENCIAL_DE_CARIMBO_INVALIDO )){
						$caqrbo = new CampanhaQrCodeBusinessImpl();
						$retorno = $caqrbo->carregarCaqrIdLivre($daofactory,$idcampanha);
/*var_dump($retorno);*/
						if($retorno->status == ConstantesVariavel::STATUS_ATIVO){
							$carimbodto->id = $retorno->id;
							$carimbodto->carimbo = $retorno->qrcodecarimbo;
							$carimbodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
							$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagem($carimbodto->msgcode);
							$ret = $caqrbo->atualizarUsuarioGerador($daofactory,$carimbodto->carimbo,$idusuario);
							
						}
									
						if($retorno->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
							$carimbodto->msgcode = ConstantesMensagem::ERRO_ACABOU_CARIMBO_CAMPANHA;
							$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($carimbodto->msgcode, 
							[
								ConstantesVariavel::P1 => $retorno->nome
							]);

						} else {
							$retorno = $dao->updateProximoCarimboLivre($idcampanha, $retorno->id);
							break;
						}
					} else {
						$daoqr = $daofactory->getCampanhaQrCodeDAO($daofactory);
						$carimboparent = $daoqr->loadParent($carimbodto->id);
						$retorno = $dao->updateProximoCarimboLivre($idcampanha, $carimboparent->id);
						$caqrbo = new CampanhaQrCodeBusinessImpl();
						$ret = $caqrbo->atualizarUsuarioGerador($daofactory,$carimboparent->id,$idusuario);

						break;
					}

				}
			}
		} else {
			$carimbodto->msgcode = ConstantesMensagem::ERRO_ACABOU_CARIMBO_CAMPANHA;
			$carimbodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($carimbodto->msgcode, 
			[
				ConstantesVariavel::P1 => $retorno->nome
			]);
		}

		return $carimbodto;
	}

	public function atualizarControladorMaximoSelos($daofactory, $idcampanha)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		if($retorno->id != null){
			if($dao->updateControladorMaximoSelos($idcampanha)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function atualizarPermissaoCashbackPorPK($daofactory, $id_campanha, $permissao)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);

		if($dao->updatePermissaoCashbackPorPK($idcampanha, $permissao)){	
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}		

		return $retorno;
	}


	
	public function atualizarAcumuladoTicketMedio($daofactory, $idcampanha)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		if($retorno->id != null){
			if($dao->updateAcumuladoTicketMedio($idcampanha, $retorno->valorTicketMedioCarimbo)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function atualizarTotalCarimbados($daofactory, $idcampanha)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		if($retorno->id != null){
			if($dao->updateTotalCarimbados($idcampanha)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function atualizarTotalCarimbosFabricados($daofactory, $idcampanha, $totalFabricar)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		if($retorno->id != null){
			if($dao->updateTotalCarimbosFabricados($idcampanha, $totalFabricar)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function atualizarProximoQrCode($daofactory, $idcampanha, $caqrid)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $dao->loadPK($idcampanha);

		if($retorno->id != null){
			if($dao->updateProximoQrCode($idcampanha, $caqrid)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			} else {
				$retorno->msgcode = ConstantesMensagem::ERRO_ATUALIZACAO_PROXIMO_QRCODE;
				$retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
					ConstantesVariavel::P1, 
				]);
			}		
		} else {
			$retorno->msgcode = ConstantesMensagem::CODIGO_DE_CAMPANHA_INVALIDO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}

	public function autalizarImagemCampanha($daofactory, $id_campanha, $nomearquivo)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);

		// resposta padrão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;


		if(!$dao->updateImagemCampanha($id_campanha, $nomearquivo)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function atualizarTotalLike($daofactory, $id_campanha, $idusuario, $islike)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);

		// resposta padrão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;

		if(!$dao->updateTotalLike($id_campanha, $idusuario, $islike)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function atualizarTotalStar($daofactory, $id_campanha, $idusuario, $star)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);

		// resposta padrão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;

		if(!$dao->updateTotalStar($id_campanha, $idusuario, $star)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}		

		//Atualiza a avaliação geral do usuário (dono da campanha)
		$campdto = $this->carregarPorID($daofactory, $id_campanha);
		$bo = new UsuarioAvaliacaoBusinessImpl();
		$usavdto = $bo->realizarUsuarioAvaliacao($daofactory, $campdto->id_usuario, $star);

		// Atualiza a avaliação do usuário na campanha
		$retorno = $this->calcularRating($daofactory, $id_campanha);
		return $retorno;
	}

	private function calcularRating($daofactory, $id_campanha)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = $this->carregarPorID($daofactory, $id_campanha);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;

		$rating = (
		($retorno->contadorStar_1 * 1) + 
		($retorno->contadorStar_2 * 2) +
		($retorno->contadorStar_3 * 3) +
		($retorno->contadorStar_4 * 4) +
		($retorno->contadorStar_5 * 5) ) / (
			$retorno->contadorStar_1 + $retorno->contadorStar_2 + $retorno->contadorStar_3 + $retorno->contadorStar_4 + $retorno->contadorStar_5 
		);
	
		if(!$dao->updateRating($id_campanha, $rating)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function atualizarStatus($daofactory, $idcampanha, $status)
	{
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$updateok = true;

		// resposta padrão
		$retorno = new DTOPadrao();

		// obtem o status atual da campanha
		$dto = $this->carregarPorID($daofactory, $idcampanha);

		// Sequencia válido da máquina de estado P -> Q -> W -> A -> I
		// Verifica a maquina de estado para troca de status
		if($status != ConstantesVariavel::STATUS_PURGE){
			if($dto->status == ConstantesVariavel::STATUS_INATIVO){
				$retorno->msgcode = ConstantesMensagem::TROCA_STATUS_INVALIDO_NEGADA;
				$updateok = false;
			} else if($dto->status == ConstantesVariavel::STATUS_PENDENTE && $status != ConstantesVariavel::STATUS_FILA){
				$retorno->msgcode = ConstantesMensagem::TROCA_STATUS_INVALIDO_PENDENTE;
				$updateok = false;
			} else if($dto->status == ConstantesVariavel::STATUS_FILA && $status != ConstantesVariavel::STATUS_TRABALHANDO) {
				$retorno->msgcode = ConstantesMensagem::TROCA_STATUS_INVALIDO_FILA;
				$updateok = false;
			} else if($dto->status == ConstantesVariavel::STATUS_TRABALHANDO && $status != ConstantesVariavel::STATUS_ATIVO){
				$retorno->msgcode = ConstantesMensagem::TROCA_STATUS_INVALIDO_TRABALHANDO;
				$updateok = false;
			} else if($dto->status == ConstantesVariavel::STATUS_ATIVO && $status != ConstantesVariavel::STATUS_INATIVO){
				$retorno->msgcode = ConstantesMensagem::TROCA_STATUS_INVALIDO_ATIVO;
				$updateok = false;
			} 

		}

		if($updateok){
			if($dao->updateStatus($idcampanha, $status)){	
				$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			}		
		}
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}

	public function isCampanhaAtiva($daofactory, $idcampanha){
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$dto = $dao->loadPK($idcampanha);
		return ($dto->status == ConstantesVariavel::STATUS_ATIVO);
	}


	public function inserir($daofactory, $dto)
	{ 
		$ok = false;

		// Verifica o sucesso de verificarPermissao
		$permdto = PermissaoHelper::verificarPermissao($daofactory, $dto->id_usuario, ConstantesPlano::PERM_CRIAR_CAMPANHA);
		if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $permdto;
		}

		// Verificar se a quantidade permitida do plano do usuário já existe na CAMP
		$campdao = $daofactory->getCampanhaDAO($daofactory);
        $qtdecaso = $campdao->countCampanhaPorUsuaId($dto->id_usuario);

		$qtdePermitido = (int) $permdto->qtdepermitida;
        if($qtdecaso >= $qtdePermitido) 
        {
            $retorno->msgcode = ConstantesMensagem::CAMPANHA_QTDE_EXCEDIDA;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
                ConstantesVariavel::P1 => $qtdePermitido,
            ]);  
            
            return $retorno;
        }

		// Monta a regra do QRCode da Campanha
		$dto->QrCodeAtivo = sha1($dto->id_usuario . $dto->dataInicio . $dto->dataTermino . Util::getCodigo(1024));
		$dto->status = ConstantesVariavel::STATUS_FILA;
		$dao = $daofactory->getCampanhaDAO($daofactory);

		$retorno = new DTOPadrao();
		if ($dao->insert($dto)) {
			$ok = true;
		}

		if ($ok) {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ERRO_INESPERADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


	public function inserirFlash($daofactory, $dto)
	{ 

		// Verifica se a chave geral de criação de campanhas para plano gratuito está ON
		$plusbo = new PlanoUsuarioBusinessImpl();
		$plusdto = $plusbo->carregarPlanoUsuarioPorStatus($daofactory,$dto->id_usuario,ConstantesVariavel::STATUS_ATIVO);

		if(VariavelHelper::getVariavel(ConstantesVariavel::CHAVE_INTERROMPER_CRIAR_CAMPANHA_PLANO_GRATUITO) == ConstantesVariavel::ATIVADO &&
			$plusdto->planoid == VariavelHelper::getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO)
		){
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::CRIAR_CAMPANHA_PLANO_GRATUITO_INTERROMPIDA;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			return $retorno;
		}

		// Verifica o sucesso de verificarPermissao
		$permdto = PermissaoHelper::verificarPermissao($daofactory, $dto->id_usuario, ConstantesPlano::PERM_CRIAR_CAMPANHA);
		if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $permdto;
		}

		// Verificar se a quantidade permitida do plano do usuário já existe na CAMP
		$campdao = $daofactory->getCampanhaDAO($daofactory);
        $qtdecaso = $campdao->countCampanhaPorUsuaId($dto->id_usuario);

		$qtdePermitido = (int) $permdto->qtdepermitida;
        if($qtdecaso >= $qtdePermitido) 
        {
            $retorno->msgcode = ConstantesMensagem::CAMPANHA_QTDE_EXCEDIDA;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
                ConstantesVariavel::P1 => $qtdePermitido,
            ]);  
            
            return $retorno;
        }


		// Obtem o máximo de cartões permitidos para esse plano do usuario
		$permdto = PermissaoHelper::verificarPermissao($daofactory, $dto->id_usuario, ConstantesPlano::PERM_MAXIMO_CARTOES);
		$maxcartoes = (double) $permdto->qtdepermitida;

		if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $permdto;
		}

		$frase = [
			"Nosso tratamento é EXCLUSIVO",
			"Você sempre em primeiro lugar"
		];
		$ok = false;

		// Monta a regra do QRCode da Campanha
		$dto->QrCodeAtivo = sha1($dto->id_usuario . $dto->dataInicio . $dto->dataTermino . Util::getCodigo(ConstantesVariavel::TAMANHO_CHAVE));
		$dto->img = ConstantesVariavel::ARQUIVO_SEM_IMAGEM;
		$dto->imgRecompensa = ConstantesVariavel::ARQUIVO_SEM_IMAGEM;
		$dto->status = ConstantesVariavel::STATUS_FILA;
		$dto->textoExplicativo = 'A recompensa é somente válida durante o prazo da campanha.\r\n'
			. 'O prazo para retirada pessoalmente é somente durante horário comercial.\r\n'
			. 'Após o prazo de validade da campanha NÃO HÁ OBRIGAÇÃO DE ENTREGA da recompensa por parte do patrocinador.\r\n';
		$dto->msgAgradecimento = "Obrigado pela preferência";
		$dto->maximoCartoes = $maxcartoes; //(int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_CARTOES_DEFAULT_LINKER);
		$dto->minimoDelay = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_DELAY_DEFAULT_LINKER);
		$dto->fraseEfeito = $frase[rand(0, count($frase)-1)];
	
		$dao = $daofactory->getCampanhaDAO($daofactory);
		$retorno = new DTOPadrao();
		if ($dao->insertFlash($dto)) {
			$ok = true;

			$maxid = $dao->loadMaxCampanhaID($dto->id_usuario);
			EstatisticaFuncaoHelper::registrarEstatisticaService($dto->id_usuario, 
				$maxid,
				ConstantesEstatisticaFuncao::FUNCAO_CRIAR_CAMPANHA
			);
		}

		//----------------------------------------------------------
		// Premiar o promotor que indicou esse usuário com FPGL
		//----------------------------------------------------------

		// falta testar se o plano do usuario é gratuito
		/* aproveita pra marcar a gratuidade do plano com base no plano mais recente */
/*		
		$pubi = new PlanoUsuarioBusinessImpl();
		$plus = $pubi->carregarPlanoUsuarioPorStatus($daofactory, $dto->id_usuario, ConstantesVariavel::STATUS_ATIVO);

		// Por padrão é considerado sempre negado o plano gratuito
		$isGratuito = ConstantesVariavel::PLANO_GRATIS_NAO;
		
		// Trouxe as informações do plano do usuario. Então, temos a necessidade de verificar se o plano ativo
		// é o plano gratuito
		if ($plus != NULL && $plus->id != NULL && $plus->usuarioid == $dto->id_usuario) {
			if($plus->planoid == (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO)) {
				$isGratuito = ConstantesVariavel::PLANO_GRATIS_SIM;				
			}
		}
*/
		$pubifpgl = new PlanoUsuarioBusinessImpl();
		if(
			(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_PERMITE_REMUNERAR_PROMOTOR) == ConstantesVariavel::ATIVADO) &&
			( ! $pubifpgl->isPlanoGratuito($daofactory, $dto->id_usuario) )
			//( $isGratuito == ConstantesVariavel::PLANO_GRATIS_NAO )
		)
		{
			$vllancar = floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_REMUNERAR_PROMOTOR));
			$usuaid_debitar = $dto->id_usuario;
			//$usuaid_debitar = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::USUA_ID_DEBITAR_REMUNERAR_PROMOTOR);
			$descricao = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::REMUNERACAO_PROMOTOR);

			// localiza a pessoa que indicou este dono de campanha
			$reinbo = new RegistroIndicacaoBusinessImpl();
			$reindto = $reinbo->pesquisarPorIdusuarioindicado($daofactory, $dto->id_usuario);
			if(! is_null($reindto))
			{
				/* pode apagar
				$cacaccbo = new CampanhaCashbackCCBusinessImpl();
				$retcc = $cacaccbo->lancarMovimentoCashbackCC($daofactory, $reindto->idUsuarioPromotor, $usuaid_debitar, $vllancar, $descricao, ConstantesVariavel::CREDITO);
				*/

				// Busca dados para popular mensagens
				$usuarioPromotor = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $reindto->idUsuarioPromotor);
				$usuarioIndicado = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->id_usuario);

				//------------------------------------------------------------------------------------------------
				// Lançar movimento sobre o Fundo de Participação Global e o conta corrente do usuário bonificado
				//------------------------------------------------------------------------------------------------
				$fpglbo = new FundoParticipacaoGlobalBusinessImpl();
				$fpglbo->lancarMovimentoFundoParticipacaoGlobal($daofactory
					, $usuaid_debitar
					, $usuarioPromotor->id
					, floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL))
					, MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::AVISO_CREDITO_FUNDO_PARTICIPACAO_GLOBAL,[
						ConstantesVariavel::P1 => $usuarioPromotor->apelido,
						ConstantesVariavel::P2 => Util::getMoeda(floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL))),
					])
				);


/*
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
					if($plusfpglbo->isPlanoGratuito($daofactory, $usuaid_debitar))
					{
						$okfpgl = false;
					}

					//---> colocar verificacao da permissao do plano porque nem todo plano pago permite retiradda do FPGL
					$permdto = PermissaoHelper::verificarPermissao($daofactory, $usuaid_debitar, ConstantesPlano::PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL);
					if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
						$okfpgl = false;
					}

					// dono da campanha tem que ter registro na USCA
					$uscafpglbo = new UsuarioCashbackBusinessImpl();
					$uscafpgldto = $uscafpglbo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $usuaid_debitar, ConstantesVariavel::STATUS_ATIVO);
					if(is_null($uscafpgldto))
					{
						$okfpgl = false;
					}

					if($okfpgl)
					{
						// Tudo Ok. Pode realizar o pagamento ao cliente que carimbou
						$dtofpgl = new FundoParticipacaoGlobalDTO();
	
						$dtofpgl->idUsuarioParticipante = $usuaid_debitar;
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
							$retfpgl = $caccfpglbo->lancarMovimentoCashbackCC($daofactory, $reindto->idUsuarioPromotor, $usuaid_debitar, $dtofpgl->valorTransacao * -1, $dtofpgl->descricao, ConstantesVariavel::CREDITO);

						}
					}	
				}

*/
				
				$msgRemunerarPromotor = MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::NOTIFICACAO_REMUNERACAO_PROMOTOR,
					[
						ConstantesVariavel::P1 => $usuarioPromotor->apelido,
						ConstantesVariavel::P2 => Util::getMoeda($vllancar), 
						ConstantesVariavel::P3 => $usuarioIndicado->apelido,
					]
				);

				// Notifica o usuario
				UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $reindto->idUsuarioPromotor, $msgRemunerarPromotor);	

				// Envia uma notificação ao ADMIN
				UsuarioNotificacaoHelper::criarNotificacaoAdmin(
					$daofactory
					, ConstantesMensagem::NOTIFICACAO_REMUNERACAO_PROMOTOR
					, [
						ConstantesVariavel::P1 => $usuarioPromotor->apelido,
						ConstantesVariavel::P2 => Util::getMoeda($vllancar), 
						ConstantesVariavel::P3 => $usuarioIndicado->apelido,
					]
				);

	
			}
		}



		if ($ok) {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		} else {
			$retorno = new DTOPadrao();
			$retorno->msgcode = ConstantesMensagem::ERRO_INESPERADO;
			$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		return $retorno;
	}


}
?>
