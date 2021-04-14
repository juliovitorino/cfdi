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

/**
* MySqlKinghostEstatisticaFuncaoDAO - Implementação DAO
*
* Changelog:
* 31/08/2019 - Inserida tabelas de estatistica de 7, 14, 30 dias para aumentar a velocidade dos dashboards
*              Agora, são abastecidas 4 tabelas que terão controle de periodicidades menores.
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2019 09:14:23
*
*/

require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoDAO.php';
require_once 'DmlSqlEstatisticaFuncao.php';

require_once '../daofactory/DmlSql.php';

class MySqlKinghostEstatisticaFuncaoDAO implements EstatisticaFuncaoDAO
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
	public function listPagina($sql, $pag, $qtde)	{	}

	public function loadSumFuncionalidadeMensal($tipo, $usuarioid, $mes, $ano)
	{
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$sql = 'select sum(`ESFU_QT_FUNCAO`) from `ESTATISTICA_FUNCAO` '
				. ' where `ESFU_IN_TIPO` = ' . "'" . $tipo . "'" 
				. ' and `USUA_ID` = ' . $usuarioid
				. ' and `ESFU_NU_ANO` = ' . $ano
				. ' and `ESFU_NU_MES` = ' . $mes;

		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql);
		if ($res){
			foreach ($res->fetch_assoc() as $key => $value) {
				$retorno = $value;
			}
		}
		return $retorno;

	}

	public function loadSumFuncionalidadeAnual($tipo, $usuarioid, $ano)
	{
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$sql = 'select sum(`ESFU_QT_FUNCAO`) from `ESTATISTICA_FUNCAO` '
				. ' where `ESFU_IN_TIPO` = ' . "'" . $tipo . "'" 
				. ' and `USUA_ID` = ' . $usuarioid
				. ' and `ESFU_NU_ANO` = ' . $ano;

		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql);
		if ($res){
			foreach ($res->fetch_assoc() as $key => $value) {
				$retorno = $value;
			}
		}
		return $retorno;

	}

	public function loadSumFuncionalidadeDiaria($tipo, $usuarioid, $dia, $mes, $ano)
	{
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$sql = 'select sum(`ESFU_QT_FUNCAO`) from `ESTATISTICA_FUNCAO` '
				. ' where `ESFU_IN_TIPO` = ' . "'" . $tipo . "'" 
				. ' and `USUA_ID` = ' . $usuarioid
				. ' and `ESFU_NU_ANO` = ' . $ano
				. ' and `ESFU_NU_MES` = ' . $mes
				. ' and `ESFU_NU_DIA` = ' . $dia;

		$conexao = $this->daofactory->getSession();
		$res = $conexao->query($sql);
		if ($res){
			foreach ($res->fetch_assoc() as $key => $value) {
				$retorno = $value;
			}
		}
		return $retorno;

	}

	public function loadCountFuncionalidade($tipo, $usuarioid)
	{
		$retorno = 0;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$sql = DmlSqlEstatisticaFuncao::SELECT_COUNT 
		. ' WHERE `' . DmlSqlEstatisticaFuncao::ESFU_IN_TIPO . '` =' . "'" . $tipo . "'"
		. ' AND `' . DmlSqlEstatisticaFuncao::USUA_ID . '` =' . $usuarioid ;	
		$res = $conexao->query($sql);
		if ($res){
			foreach ($res->fetch_assoc() as $key => $value) {
				$retorno = $value;
			}
		}
		return $retorno;

	}

	public function loadPK($id)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlEstatisticaFuncao::SELECT . ' WHERE ' . DmlSqlEstatisticaFuncao::ESFU_ID . '=' . $id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;

	}


	public function insert($dto) 
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::INS);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							,$dto->usuarioid
							,$dto->projetoid
							,$dto->ano
							,$dto->mes
							,$dto->dia
							,$dto->tipo );

		// Insere registro na estatistica geral
		if ($stmt->execute())
		{
			// Insere registro na estatistica 7 dias
			$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::INS,DmlSqlEstatisticaFuncao::TABELA,'_07D') );
			$stmt->bind_param(DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::STRING_TYPE 
								,$dto->usuarioid
								,$dto->projetoid
								,$dto->ano
								,$dto->mes
								,$dto->dia
								,$dto->tipo );
			if($stmt->execute()){
				// Insere registro na estatistica 14 dias
				$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::INS,DmlSqlEstatisticaFuncao::TABELA,'_14D') );
				$stmt->bind_param(DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::STRING_TYPE 
									,$dto->usuarioid
									,$dto->projetoid
									,$dto->ano
									,$dto->mes
									,$dto->dia
									,$dto->tipo );
				if($stmt->execute()){
					// Insere registro na estatistica 30 dias
					$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::INS,DmlSqlEstatisticaFuncao::TABELA,'_30D') );
					$stmt->bind_param(DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::STRING_TYPE 
										,$dto->usuarioid
										,$dto->projetoid
										,$dto->ano
										,$dto->mes
										,$dto->dia
										,$dto->tipo );
					if($stmt->execute()){
						$retorno = true;
					}
				}
			}
		}

		return $retorno;
	}

	public function loadUIX($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{	
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlEstatisticaFuncao::SELECT . ' WHERE ' . DmlSqlEstatisticaFuncao::ESFU_NU_ANO . '=' . $ano 
																. ' AND ' . DmlSqlEstatisticaFuncao::ESFU_NU_MES . '=' . $mes 
																. ' AND ' . DmlSqlEstatisticaFuncao::ESFU_NU_DIA . '=' . $dia 
																. ' AND ' . DmlSqlEstatisticaFuncao::ESFU_IN_TIPO . '=' . "'" . $tipo . "'"
																. ' AND ' . DmlSqlEstatisticaFuncao::USUA_ID . '=' . $usuarioid 
																. ' AND ' . DmlSqlEstatisticaFuncao::PROJ_ID . '=' . $projetoid );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;


	}

	public function updateQtdePK($id)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_PK);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							,$id);

		if ($stmt->execute())
		{

			$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_PK,DmlSqlEstatisticaFuncao::TABELA,'_07D'));
			$stmt->bind_param(DmlSql::INTEGER_TYPE ,$id);
	
			if ($stmt->execute())
			{
				$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_PK,DmlSqlEstatisticaFuncao::TABELA,'_14D'));
				$stmt->bind_param(DmlSql::INTEGER_TYPE ,$id);
		
				if ($stmt->execute())
				{
					$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_PK,DmlSqlEstatisticaFuncao::TABELA,'_30D'));
					$stmt->bind_param(DmlSql::INTEGER_TYPE ,$id);
			
					if ($stmt->execute())
					{
						$retorno = true;
					}
				}
			}
		}

		return $retorno;
	}

	public function updateQtdeAlternativa($tipo, $dia, $mes, $ano, $usuarioid, $projetoid, $qtde)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE_ALTERNATIVA);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$qtde
							,$ano
							,$mes
							,$dia
							,$tipo
							,$usuarioid
							,$projetoid);

		if ($stmt->execute())
		{
			$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE_ALTERNATIVA, DmlSqlEstatisticaFuncao::TABELA, '_07D'));
			$stmt->bind_param(DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::STRING_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								,$qtde
								,$ano
								,$mes
								,$dia
								,$tipo
								,$usuarioid
								,$projetoid);
	
			if ($stmt->execute())
			{
				$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE_ALTERNATIVA, DmlSqlEstatisticaFuncao::TABELA, '_14D'));
				$stmt->bind_param(DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::STRING_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									,$qtde
									,$ano
									,$mes
									,$dia
									,$tipo
									,$usuarioid
									,$projetoid);
		
				if ($stmt->execute())
				{
					$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE_ALTERNATIVA, DmlSqlEstatisticaFuncao::TABELA, '_30D'));
					$stmt->bind_param(DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::STRING_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										,$qtde
										,$ano
										,$mes
										,$dia
										,$tipo
										,$usuarioid
										,$projetoid);
			
					if ($stmt->execute())
					{
						$retorno = true;
					}
				}
			}
		}

		return $retorno;
	}


	public function updateQtde($tipo, $dia, $mes, $ano, $usuarioid, $projetoid)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE);
		$stmt->bind_param(DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$ano
							,$mes
							,$dia
							,$tipo
							,$usuarioid
							,$projetoid);

		if ($stmt->execute())
		{
			$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE,DmlSqlEstatisticaFuncao::TABELA,'_07D'));
			$stmt->bind_param(DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::STRING_TYPE 
								. DmlSql::INTEGER_TYPE 
								. DmlSql::INTEGER_TYPE 
								,$ano
								,$mes
								,$dia
								,$tipo
								,$usuarioid
								,$projetoid);
	
			if ($stmt->execute())
			{
				$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE,DmlSqlEstatisticaFuncao::TABELA,'_14D'));
				$stmt->bind_param(DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::STRING_TYPE 
									. DmlSql::INTEGER_TYPE 
									. DmlSql::INTEGER_TYPE 
									,$ano
									,$mes
									,$dia
									,$tipo
									,$usuarioid
									,$projetoid);
		
				if ($stmt->execute())
				{
					$stmt = $conexao->prepare(DmlSqlEstatisticaFuncao::addSufixo(DmlSqlEstatisticaFuncao::UPD_INCREMENTA_QTDE,DmlSqlEstatisticaFuncao::TABELA,'_30D'));
					$stmt->bind_param(DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::STRING_TYPE 
										. DmlSql::INTEGER_TYPE 
										. DmlSql::INTEGER_TYPE 
										,$ano
										,$mes
										,$dia
										,$tipo
										,$usuarioid
										,$projetoid);
			
					if ($stmt->execute())
					{
						$retorno = true;
					}
				}
			}
		}

		return $retorno;
	}

	/**
	* getDTO() - Transforma o resultset em DTO
	*/
	public function getDTO($resultset)
	{
		//echo var_dump($resultset); // ótimo pra debugar
		$retorno = new EstatisticaFuncaoDTO();
		$retorno->id = $resultset[DmlSqlEstatisticaFuncao::ESFU_ID];
		$retorno->usuarioid = $resultset[DmlSqlEstatisticaFuncao::USUA_ID];
		$retorno->projetoid = $resultset[DmlSqlEstatisticaFuncao::PROJ_ID];
		$retorno->ano = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_ANO];
		$retorno->mes = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_MES];
		$retorno->dia = $resultset[DmlSqlEstatisticaFuncao::ESFU_NU_DIA];
		$retorno->tipo = $resultset[DmlSqlEstatisticaFuncao::ESFU_IN_TIPO];
		$retorno->qtde = $resultset[DmlSqlEstatisticaFuncao::ESFU_QT_FUNCAO];
		$retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlEstatisticaFuncao::ESFU_DT_CADASTRO]);
		$retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlEstatisticaFuncao::ESFU_DT_UPDATE]);

		return $retorno;
	}

}
?>
