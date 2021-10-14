<?php

/**
 * MySqlKinghostCampanhaDAO - Implementação DAO
 */

require_once 'campanhaQrCodeDTO.php';
require_once 'campanhaQrCodeDAO.php';
require_once 'DmlSqlCampanhaQrCode.php';

require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaQrCodeDAO implements CampanhaQrCodeDAO
{
	private $daofactory;

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto){ }
	public function delete($dto) {	}
	public function load($dto) 	{	}
	public function listAll()
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT);
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

	public function loadQRCode($qrcode)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_QRCODE . "= '" . $qrcode . "'");
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function loadQRCodePorStatus($qrc, $status)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_QRCODE . "= '" . $qrc
		. "' AND " . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . "= '$status'"  );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function loadQRCodeImpressaoPorStatus($qrc, $status)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$sql = DmlSqlCampanhaQrCode::SELECT 
		. ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_QRCODEP . "= '" . $qrc
		. "' AND " . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . "= '$status'" ;
		$res = $conexao->query($sql);
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function loadTicketPorStatus($ticket, $status)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_TICKET . "= '" . $ticket
		. "' AND " . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . "= '" . $status . "'"  );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function loadCaqrIdLivre($idcampanha){
		$retorno = NULL;
		$sql = 'select `CAQR_ID` from ' . DmlSqlCampanhaQrCode::TABELA
		. ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . "=" . $idcampanha
		. " AND `CAQR_IN_STATUS` = 'A'"
		. ' AND `CAQR_NU_ORDER`in (select MIN(`CAQR_NU_ORDER`) from ' . DmlSqlCampanhaQrCode::TABELA
		. ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . "=" . $idcampanha
		. " AND `CAQR_IN_STATUS` = 'A') ";
//var_dump($sql);
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql);

		if ($res){
			$retorno = $res->fetch_assoc();
			$retorno = $retorno['CAQR_ID'];
		}
		return $retorno;


	}

	public function loadParent($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID_PARENT . "='" . $id . "'" );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function loadPK($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID . "='" . $id . "'" );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

    public function updateStatusPorCarimbo($carimboqr, $status)
	{
		$retorno = false;
		
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_STATUS_POR_CARIMBOQR);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							,$status
							,$carimboqr);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

    public function updateUsuarioGeradorQRCode($caqrid, $idusuario)
	{
		$retorno = false;
		
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_USUA_ID_GERADOR);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							,$idusuario
							,$caqrid);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateStatusPorTicket($ticket, $status)
	{
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_STATUS_POR_TICKET);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							,$ticket
							,$status);
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
		$stmt = $conexao->prepare(DmlSqlCampanhaQrCode::INS);
		$stmt->bind_param(	DmlSql::STRING_TYPE
							.DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$dto->id
							,$dto->id_campanha
							,$dto->qrcodecarimbo
							,$dto->qrcodecarimboImpressao
							,$dto->ticket
							,$dto->status
							,$dto->parent
							,$dto->order
							,$dto->idusuarioGerador );
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
		//echo var_dump($resultset); // ótimo pra debugar
		if(is_null($resultset)) {
			return NULL;
		}
		/*
		$retorno = new CampanhaQrCodeDTO();
		$retorno->id = $resultset[DmlSqlCampanhaQrCode::CAQR_ID];
		$retorno->id_campanha = $resultset[DmlSqlCampanhaQrCode::CAMP_ID];
		$retorno->qrcodecarimbo = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODE];
		$retorno->order = $resultset[DmlSqlCampanhaQrCode::CAQR_NU_ORDER];
		$retorno->idusuarioGerador = $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR] == null ? null : (int) $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR] ;
		$retorno->parent = $resultset[DmlSqlCampanhaQrCode::CAQR_ID_PARENT];
		$retorno->ticket = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_TICKET];
		$retorno->status = $resultset[DmlSqlCampanhaQrCode::CAQR_IN_STATUS];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_UPDATE]);
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		*/
        $retorno = new CampanhaQrCodeDTO();
        $retorno->id = $resultset[DmlSqlCampanhaQrCode::CAQR_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_ID];
        $retorno->parent = $resultset[DmlSqlCampanhaQrCode::CAQR_ID_PARENT] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_ID_PARENT];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaQrCode::CAMP_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAMP_ID];
        $retorno->qrcodecarimbo = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODE] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODE];
        $retorno->qrcodecarimboImpressao = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODEP] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODEP];
        $retorno->order = $resultset[DmlSqlCampanhaQrCode::CAQR_NU_ORDER] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_NU_ORDER];
        $retorno->ticket = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_TICKET] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_TX_TICKET];
        $retorno->idusuarioGerador = $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR];
        $retorno->status = $resultset[DmlSqlCampanhaQrCode::CAQR_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

		return $retorno;
	}

/**
* countCampanhaQrCodeIdCampanhaPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_QRCODES 
*
* @see listPagina()
*
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

	public function  countCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status)
	{   
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCampanhaQrCode::SQL_COUNT 
		. ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . " = $idcampanha "
		. ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
		);
		if ($res){
			$tmp = $res->fetch_assoc();
			$retorno = $tmp['contador'];
		}
		return $retorno;

	}

/**
* listCampanhaQrCodeIdCampanhaPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaQrCode com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_QRCODES 
*
* @see listPagina()
*
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

	public function listCampanhaQrCodeIdCampanhaPorStatus($idcampanha, $status, $pag, $qtde, $coluna, $ordem)
	{
		$sql = DmlSqlCampanhaQrCode::SELECT 
		. ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . " = $idcampanha "
		. ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
		. ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
		return $this->listPagina($sql, $pag, $qtde);
	}


}
?>
