<?php

/**
 * MySqlKinghostCampanhaDAO - Implementação DAO
 */

require_once 'campanhaDTO.php';
require_once 'campanhaDAO.php';
require_once 'DmlSqlCampanha.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaDAO implements CampanhaDAO
{
	private $daofactory;

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function load($dto) 	{	}
	public function listAll() 	{	}
	
	public function update($dto)
	{	
		$retorno = false;
		$di = Util::DMYHMiS_to_MySQLDate($dto->dataInicio);
		$df = Util::DMYHMiS_to_MySQLDate($dto->dataTermino);

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_PK);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							//. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::DOUBLE_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$dto->nome
							,$dto->textoExplicativo
							,$di
							,$df
							//,$dto->maximoCartoes
							,$dto->fraseEfeito
							,$dto->recompensa
							,$dto->maximoSelos
							,$dto->valorTicketMedioCarimbo
							,$dto->msgAgradecimento
							,$dto->id );
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updatePermissaoCashbackPorPK($idcampanha, $permissao)
	{	
		$retorno = false;

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_CAMP_IN_CASHBACK);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$permissao
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	
	public function delete($dto)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::DEL_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE
							,$dto->id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function listCampanhasStatus($status)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanha::SELECT 
		. 'WHERE ' . ' `' 
		. DmlSqlCampanha::CAMP_IN_STATUS . "` = '" . $status . "' "
		. 'ORDER BY ' . DmlSqlCampanha::CAMP_DT_UPDATE . ' DESC ' );
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function listCampanhasUsuarioStatus($id_usuario, $status)	
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$sql = DmlSqlCampanha::SELECT . 'WHERE ' . ' `' 
		. DmlSqlCampanha::USUA_ID . '` = ' . $id_usuario 
		. " AND `" . DmlSqlCampanha::CAMP_IN_STATUS . "` = '$status' "
		. ' ORDER BY ' . ' `' . DmlSqlCampanha::CAMP_DT_UPDATE . '` DESC';

		$res = $conexao->query($sql);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listCampanhasUsuario($id_usuario)	
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanha::SELECT . 'WHERE ' . ' `' . DmlSqlCampanha::USUA_ID . '` = ' . $id_usuario 
		. ' ORDER BY ' . ' `' . DmlSqlCampanha::CAMP_DT_UPDATE . '` DESC'  );
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listPagina($sql, $pag, $qtde)
	{
		$retorno = array();

		$final = $pag * $qtde - $qtde;

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql . ' LIMIT ' . $final . ',' . $qtde );
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function loadPK($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$sql = DmlSqlCampanha::SELECT . ' WHERE ' . DmlSqlCampanha::CAMP_ID . '=' . $id ;
		$res = $conexao->query($sql);

		if ($res->num_rows > 0){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function loadMaxCampanhaID($id_usuario)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanha::SELECT_ULT_CAMP_ID . ' WHERE ' . DmlSqlCampanha::USUA_ID . '=' . $id_usuario );
		if ($res){
			$resultset = $res->fetch_assoc();
			$retorno = $resultset['MAX_CAMP_ID'];
		}
		return $retorno == NULL ? 0 : $retorno;

	}

	public function updateTotalCartoesAdicionados($id_campanha, $qtde)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_ADD_CAMP_NU_MAX_CARTAO_FABRICADOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$qtde
							,$id_campanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateTotalCarimbosAdicionados($id_campanha, $qtde)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_ADD_TOTAL_CARIMBOS_FABRICADOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$qtde
							,$id_campanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateTotalCarimbosFabricados($idcampanha, $total)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_TOTAL_CARIMBOS_FABRICADOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$total
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateProximoCarimboLivre($idcampanha, $caqrid)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_PROXIMO_CAQR_ID);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							.DmlSql::INTEGER_TYPE 
							,$caqrid
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateTotalLike($idcampanha, $idusuario, $islike)
	{	
		$retorno = false;
		$sql = $islike ? DmlSqlCampanha::UPD_NU_LIKE_INC : DmlSqlCampanha::UPD_NU_LIKE_DEC;

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare($sql);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateRating($idcampanha, $rating)
	{	
		$retorno = false;
		$sql = DmlSqlCampanha::UPD_CAMP_NU_RATING;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare($sql);
		$stmt->bind_param( DmlSql::DOUBLE_TYPE
							. DmlSql::INTEGER_TYPE 
							, $rating
							, $idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	

	public function updateTotalStar($idcampanha, $idusuario, $star)
	{	
		$retorno = false;
		switch ($star) {
			case '1':
				$sql = DmlSqlCampanha::UPD_CAMP_NU_CONT_STAR_1;
				break;
			case '2':
				$sql = DmlSqlCampanha::UPD_CAMP_NU_CONT_STAR_2;
				break;
			case '3':
				$sql = DmlSqlCampanha::UPD_CAMP_NU_CONT_STAR_3;
				break;
			case '4':
				$sql = DmlSqlCampanha::UPD_CAMP_NU_CONT_STAR_4;
				break;
			case '5':
				$sql = DmlSqlCampanha::UPD_CAMP_NU_CONT_STAR_5;
				break;
			
			default:
				return false;
		}

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare($sql);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateTotalCarimbados($idcampanha)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_TOTAL_CARIMBADOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateTotalCartoesDistribuidos($idcampanha)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_NU_CONT_CARTAO);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateControladorMaximoSelos($idcampanha)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_CAMP_IN_UPD_MAX_SELOS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateAcumuladoTicketMedio($idcampanha, $vlticket)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_VL_ACM_TICKET);
		$stmt->bind_param(DmlSql::DOUBLE_TYPE 
							. DmlSql::INTEGER_TYPE 
							, $vlticket
							, $idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateProximoQrCode($idcampanha, $caqrid)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_PROXIMO_QRCODE);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$caqrid
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateImagemCampanha($idcampanha, $nomearquivo)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_IMAGEM_CAMPANHA);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$nomearquivo
							,$idcampanha);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateStatus($id, $status)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::UPD_STATUS);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$status
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function insert($dto) 
	{		
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->id_usuario
							,$dto->nome
							,$dto->textoExplicativo
							,$dto->dataInicio
							,$dto->dataTermino
							,$dto->maximoCartoes
							,$dto->minimoDelay
							,$dto->QrCodeAtivo
							,$dto->status
							,$dto->fraseEfeito
							,$dto->recompensa );
							if ($stmt->execute())
							{
								$retorno = true;
							}

							return $retorno;
	}
	
	public function insertFlash($dto) 
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanha::INS_FLASH);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->id_usuario
							,$dto->nome
							,$dto->textoExplicativo
							,$dto->maximoCartoes
							,$dto->minimoDelay
							,$dto->QrCodeAtivo
							,$dto->status
							,$dto->fraseEfeito
							,$dto->recompensa
							,$dto->msgAgradecimento
							,$dto->img
							,$dto->imgRecompensa );
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}
	
	/**
	 * getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//var_dump($resultset); // ótimo pra debugar
		$retorno = new CampanhaDTO();
		$retorno->id = $resultset[DmlSqlCampanha::CAMP_ID];
		$retorno->id_usuario = $resultset[DmlSqlCampanha::USUA_ID];
		$retorno->nome = $resultset[DmlSqlCampanha::CAMP_TX_NOME];
		$retorno->textoExplicativo = $resultset[DmlSqlCampanha::CAMP_TX_EXPLICATIVO];
		$retorno->msgAgradecimento = $resultset[DmlSqlCampanha::CAMP_TX_AGRADECIMENTO];
		$retorno->dataInicio = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanha::CAMP_DT_INICIO]);
		$retorno->dataTermino = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanha::CAMP_DT_TERMINO]);
		$retorno->maximoCartoes = (int) $resultset[DmlSqlCampanha::CAMP_NU_MAX_CARTAO];
		$retorno->contadorCartoes = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_CARTAO];
		$retorno->maximoSelos = (int) $resultset[DmlSqlCampanha::CAMP_NU_MAX_SELOS];
		$retorno->permiteAlterarMaximoSelos = $resultset[DmlSqlCampanha::CAMP_IN_UPD_MAX_SELOS] == ConstantesVariavel::STATUS_PERMITIDO;
		$retorno->minimoDelay = $resultset[DmlSqlCampanha::CAMP_NU_MIN_DELAY];
		$retorno->QrCodeAtivo = $resultset[DmlSqlCampanha::CAMP_TX_QRCODE_ATIVO];
		$retorno->fraseEfeito = $resultset[DmlSqlCampanha::CAMP_TX_FRASE_EFEITO];
		$retorno->recompensa = $resultset[DmlSqlCampanha::CAMP_TX_RECOMPENSA];
		$retorno->proximoQrCode = $resultset[DmlSqlCampanha::CAMP_ID_PROXIMO_CAQR_ID];
		$retorno->totalCarimbos = $resultset[DmlSqlCampanha::CAMP_TT_CARIMBOS];
		$retorno->totalCarimbados = $resultset[DmlSqlCampanha::CAMP_TT_CARIMBADOS];
		$retorno->valorAcmTicketMedio = $resultset[DmlSqlCampanha::CAMP_VL_ACM_TICKET] == NULL ? 0 : (double) $resultset[DmlSqlCampanha::CAMP_VL_ACM_TICKET];
		$retorno->valorTicketMedioCarimbo = $resultset[DmlSqlCampanha::CAMP_VL_TICKET_MEDIO] == NULL ? 0 : (double) $resultset[DmlSqlCampanha::CAMP_VL_TICKET_MEDIO];
		$retorno->valorAcmTicketMedioMoeda = $resultset[DmlSqlCampanha::CAMP_VL_ACM_TICKET] == NULL ? Util::getMoeda(0.00) : Util::getMoeda((double) $resultset[DmlSqlCampanha::CAMP_VL_ACM_TICKET]);
		$retorno->valorTicketMedioCarimboMoeda = $resultset[DmlSqlCampanha::CAMP_VL_TICKET_MEDIO] == NULL ? Util::getMoeda(0.00) : Util::getMoeda((double) $resultset[DmlSqlCampanha::CAMP_VL_TICKET_MEDIO]);
		$retorno->contadorLike = (int) $resultset[DmlSqlCampanha::CAMP_NU_LIKE];
		$retorno->contadorStar_1 = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_STAR_1];
		$retorno->contadorStar_2 = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_STAR_2];
		$retorno->contadorStar_3 = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_STAR_3];
		$retorno->contadorStar_4 = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_STAR_4];
		$retorno->contadorStar_5 = (int) $resultset[DmlSqlCampanha::CAMP_NU_CONT_STAR_5];
		$retorno->ratingCalculado = (double) $resultset[DmlSqlCampanha::CAMP_NU_RATING];
		$retorno->permissaoCuringa = $resultset[DmlSqlCampanha::CAMP_IN_CURINGA];
		$retorno->permissaoCashback = $resultset[DmlSqlCampanha::CAMP_IN_CASHBACK];
		$retorno->status = $resultset[DmlSqlCampanha::CAMP_IN_STATUS];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanha::CAMP_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanha::CAMP_DT_UPDATE]);
		$retorno->valorMeta = ($retorno->totalCarimbos - $retorno->totalCarimbados) * $retorno->valorTicketMedioCarimbo + $retorno->valorAcmTicketMedio;
		$retorno->valorMetaMoeda = Util::getMoeda($retorno->valorMeta);

		$retorno->img = $resultset[DmlSqlCampanha::CAMP_TX_IMG] == ConstantesVariavel::ARQUIVO_SEM_IMAGEM 
		? Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_IMG_SEM_CAMPANHA),[
			ConstantesVariavel::P1 => $resultset[DmlSqlCampanha::CAMP_TX_IMG],
		])
		: Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_IMG_CAMPANHA),[
			ConstantesVariavel::P1 => $retorno->id_usuario,
			ConstantesVariavel::P2 => $retorno->id,
			ConstantesVariavel::P3 => $resultset[DmlSqlCampanha::CAMP_TX_IMG],
		]);
		$retorno->imgRecompensa  = $resultset[DmlSqlCampanha::CAMP_TX_IMG_RECOMPENSA] == ConstantesVariavel::ARQUIVO_SEM_IMAGEM 
		? Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_IMG_SEM_CAMPANHA),[
			ConstantesVariavel::P1 => $resultset[DmlSqlCampanha::CAMP_TX_IMG],
		])
		: Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::URL_IMG_RECOMPENSA),[
			ConstantesVariavel::P1 => $retorno->id_usuario,
			ConstantesVariavel::P2 => $retorno->id,
			ConstantesVariavel::P3 => $resultset[DmlSqlCampanha::CAMP_TX_IMG_RECOMPENSA],
		]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
//var_dump($retorno)		;
		return $retorno;

	}

}
?>
