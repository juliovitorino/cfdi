<?php

/**
 * MySqlKinghostCartaoDAO - Implementação DAO
 * 
 * ================================================================================
 *  AAAA  TTTTTT
 * AA  AA   TT
 * AA  AA   TT
 * AAAAAA   TT
 * AA  AA   TT
 * AA  AA   TT
 * ================================================================================
 * NÃO SOBREESCREVER ESTA CLASSE COM O GERADOR DE CÓDIGO. CLASSE AMPLAMENTE
 * CUSTOMIZADA.
 * 
 * 
 */

require_once 'cartaoDTO.php';
require_once 'cartaoDAO.php';
require_once 'DmlSqlCartao.php';

require_once '../daofactory/DmlSql.php';
require_once '../util/util.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCartaoDAO implements CartaoDAO
{
	private $daofactory;

	function __construct($daofactory)
	{
		$this->daofactory = $daofactory;
	}

	public function update($dto){ }
	public function delete($dto) {	}
	public function load($dto) 	{	}
	public function listAll() 	{	}

	public function listAllCartaoFavoritosPorUsuarioStatus($idusuario, $status)
	{
		$retorno = array();

		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT 
		. ' WHERE ' . DmlSqlCartao::COLS[2] . ' = ' . $idusuario 
		. ' AND ' . DmlSqlCartao::COLS[8] . " = 'S' " 
		. ' AND ' . DmlSqlCartao::COLS[4] . " = '" . $status . "'" 
		. ' ORDER BY ' . DmlSqlCartao::COLS[6] . " DESC" 
		);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listAllCartaoPorUsuarioProcessoResgate($idusuario)
	{
		$retorno = array();
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT 
				. ' WHERE ' . DmlSqlCartao::COLS[2] . ' = ' . $idusuario 
				. ' AND ' . DmlSqlCartao::COLS[4] . " IN ('0','1','2','3','4')" 
				. ' ORDER BY ' . DmlSqlCartao::COLS[6] . " DESC" 
			);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listAllCartaoComentarios($idcampanha, $isPositivo, $qtdeComentarios)
	{

		$tipoComentario = $isPositivo ? "'3','4','5'" : "'1','2'" ;
		$sql = DmlSqlCartao::SQL_SELECT 
		. ' WHERE ' . DmlSqlCartao::COLS[1] . " = $idcampanha "
		. ' AND ' . DmlSqlCartao::COLS[15] . " IN ($tipoComentario) "
		. ' ORDER BY '. DmlSqlCartao::COLS[17] . ' DESC';

		if($qtdeComentarios > 0) {
			$sql = $sql . " LIMIT $qtdeComentarios " ;
		}

		$retorno = array();
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listAllCartaoPorUsuarioStatus($idusuario, $status)
	{
		$retorno = array();
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT 
				. ' WHERE ' . DmlSqlCartao::COLS[2] . ' = ' . $idusuario 
				. ' AND ' . DmlSqlCartao::COLS[4] . " = '" . $status . "'" 
				. ' ORDER BY ' . DmlSqlCartao::COLS[6] . " DESC" 
			);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}


	public function listAllCartaoPorUsuarioStatus10M($idusuario, $status)
	{
		$retorno = array();
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT 
				. ' WHERE ' . DmlSqlCartao::COLS[2] . ' = ' . $idusuario 
				. ' AND ' . DmlSqlCartao::COLS[4] . " = '" . $status . "'" 
				. ' ORDER BY ' . DmlSqlCartao::COLS[6] . " DESC " 
				. ' LIMIT 10'
			);
		if ($res){
			while ($row = $res->fetch_assoc()) {
				array_push($retorno, $this->getDTO($row));
			}
		}
		return $retorno;
	}

	public function listParticipantesCampanha($id_campanha, $pag, $qtde)
	{
		$sql = DmlSqlCartao::SQL_SELECT 
		. ' WHERE ' . DmlSqlCartao::COLS[1] . " = $id_campanha"
		. ' AND ' . DmlSqlCartao::COLS[4] . " = '" . ConstantesVariavel::STATUS_ATIVO . "'"
		. ' ORDER BY ' . DmlSqlCartao::COLS[6] . " DESC";
		return $this->listPagina($sql, $pag, $qtde);
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

	public function countCartaoPorCampId($id_campanha)
	{	
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_COUNT . ' WHERE ' 
		. DmlSqlCartao::COLS[1] . '=' . $id_campanha);
		if ($res){
			$tmp = $res->fetch_assoc();
			$retorno = $tmp['contador'];
		}
		return $retorno;

	}

	public function countParticipantesCampanha($id_campanha)
	{	
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_COUNT . ' WHERE ' 
		. DmlSqlCartao::COLS[1] . '=' . $id_campanha 
		. ' AND ' . DmlSqlCartao::COLS[4] . "= '" . ConstantesVariavel::STATUS_ATIVO . "'"
		);
		if ($res){
			$tmp = $res->fetch_assoc();
			$retorno = $tmp['contador'];
		}
		return $retorno;

	}


	public function loadCampanhaUsuarioStatus($idusuario, $idcampanha, $status)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT . ' WHERE ' . DmlSqlCartao::COLS[1] . '=' . $idcampanha 
											. ' AND ' . DmlSqlCartao::COLS[2] . '=' . $idusuario
											. ' AND ' . DmlSqlCartao::COLS[4] . "= '" . $status . "'"
											. ' ORDER BY ' . DmlSqlCartao::COLS[0] . ' DESC ' );
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
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT . ' WHERE ' . DmlSqlCartao::COLS[0] . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function loadHashResgate($hash)
	{	

		$retorno = new CartaoDTO();
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlCartao::SQL_SELECT . ' WHERE ' . DmlSqlCartao::COLS[9] . "= '" . $hash . "'");
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}

	public function incrementarContador($id,$qrcodecarimbo)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_INCREMENTA_CONTADOR);
		$stmt->bind_param(DmlSql::STRING_TYPE
							.DmlSql::INTEGER_TYPE 
							,$qrcodecarimbo
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateMoverCartaoInteiroParaOutroUsuario($idusuarioDestino, $idCartao)
	{	

		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_USUA_ID);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE
							,$idusuarioDestino
							,$idCartao);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateDataCartaoCompletou($id)
	{	

		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_CART_DT_COMPLETOU);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateDataCartaoValidou($id)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_CART_DT_VALIDOU);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateDataCartaoEntregou($id)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_CART_DT_ENTREGOU_REC);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}


	public function updateDataCartaoRecebeuRecompensa($id)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_CART_DT_CONFIRM_RECEBEU);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateRatingComentario($id, $rating, $comentario)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_RATING_COMENT);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::STRING_TYPE
							. DmlSql::INTEGER_TYPE 
							,$rating
							,$comentario
							,$id);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateFavorito($idcartao, $isFavorito)
	{	
		$retorno = false;
		$favorito = $isFavorito ? ConstantesVariavel::SIM : ConstantesVariavel::NAO;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_FAVORITO);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$favorito
							,$idcartao);
		if ($stmt->execute())
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function updateLike($id, $isLike)
	{	
		$retorno = false;
		$like = $isLike ? ConstantesVariavel::SIM : ConstantesVariavel::NAO;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_LIKE);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$like
							,$id);
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
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_UPD_STATUS);
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
		$stmt = $conexao->prepare(DmlSqlCartao::SQL_INS);
		$stmt->bind_param(	DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->id_campanha
							,$dto->id_usuario
							,$dto->hashresgate);
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
		$retorno = new CartaoDTO();
		$retorno->id = (int) $resultset[DmlSqlCartao::COLS[0]];
		$retorno->id_campanha = (int) $resultset[DmlSqlCartao::COLS[1]];
		$retorno->id_usuario = (int) $resultset[DmlSqlCartao::COLS[2]];
		$retorno->contador = (int) $resultset[DmlSqlCartao::COLS[3]];
		$retorno->favorito = $resultset[DmlSqlCartao::COLS[8]];
		$retorno->dataCompletouCartao = $resultset[DmlSqlCartao::COLS[10]] != null ? Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[10]]) : null;
		$retorno->dataValidouCartao = $resultset[DmlSqlCartao::COLS[11]] != null ? Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[11]]) : null;
		$retorno->dataEntregouRecompensa = $resultset[DmlSqlCartao::COLS[12]] != null ? Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[12]]) : null;
		$retorno->dataConfirmouRecebeuRecompensa = $resultset[DmlSqlCartao::COLS[13]] != null ? Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[13]]) : null;
		$retorno->dataRating = $resultset[DmlSqlCartao::COLS[17]] != null ? Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[17]]) : null;
		$retorno->status = $resultset[DmlSqlCartao::COLS[4]];
		$retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[5]]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartao::COLS[6]]);
		$retorno->carimbos = $resultset[DmlSqlCartao::COLS[7]];
		$retorno->hashresgate = $resultset[DmlSqlCartao::COLS[9]];
		$retorno->like = $resultset[DmlSqlCartao::COLS[14]];
		$retorno->rating = $resultset[DmlSqlCartao::COLS[15]];
		$retorno->comentario = $resultset[DmlSqlCartao::COLS[16]];
		$retorno->idselocuringa =  $resultset[DmlSqlCartao::COLS[18]] != null ? (int) $resultset[DmlSqlCartao::COLS[18]] : 0;
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		
		return $retorno;
	}

}
?>
