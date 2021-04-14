<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjeto - DML para tabela
 */
class DmlSqlProjeto extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO';

	// colunas da tabela
	const PROJ_ID = 'PROJ_ID';
	const USUA_ID = 'USUA_ID';
	const PROJ_NM_NOME = 'PROJ_NM_NOME';
	const PROJ_TX_EMAIL = 'PROJ_TX_EMAIL';
	const PROJ_TX_PCHAVE = 'PROJ_TX_PCHAVE';
	const PROJ_TX_HEADLINE = 'PROJ_TX_HEADLINE';
	const PROJ_TX_PDIGITAL = 'PROJ_TX_PDIGITAL';
	const PROJ_NM_NICHO = 'PROJ_NM_NICHO';
	const PROJ_NM_PROD = 'PROJ_NM_PROD';
	const PROJ_TX_DESC_PROD = 'PROJ_TX_DESC_PROD';
	const PROJ_TX_TIPO_PROD = 'PROJ_TX_TIPO_PROD';
	const PROJ_VL_PROD = 'PROJ_VL_PROD';
	const PROJ_TX_HOTLNK = 'PROJ_TX_HOTLNK';
	const PROJ_TX_CHKLNK = 'PROJ_TX_CHKLNK';
	const PROJ_NM_AUTORIDADE = 'PROJ_NM_AUTORIDADE';
	const PROJ_TX_BREVE_DESC = 'PROJ_TX_BREVE_DESC';
	const PROJ_TX_URL_MINISITE = 'PROJ_TX_URL_MINISITE';
	const PROJ_IN_STATUS = 'PROJ_IN_STATUS';
	const PROJ_DT_CADASTRO = 'PROJ_DT_CADASTRO';
	const PROJ_DT_UPDATE = 'PROJ_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` ('
				. '`USUA_ID`, '
				. '`PROJ_NM_NOME`,'
				. '`PROJ_TX_EMAIL`,'
				. '`PROJ_TX_PCHAVE`,'
				. '`PROJ_TX_HEADLINE`,'
				. '`PROJ_TX_PDIGITAL`,'
				. '`PROJ_NM_NICHO`,'
				. '`PROJ_NM_PROD`,'
				. '`PROJ_TX_DESC_PROD`,'
				. '`PROJ_TX_TIPO_PROD`,'
				. '`PROJ_VL_PROD`,'
				. '`PROJ_TX_HOTLNK`,'
				. '`PROJ_TX_CHKLNK`,'
				. '`PROJ_NM_AUTORIDADE`,'
				. '`PROJ_TX_BREVE_DESC`,'
				. '`PROJ_TX_URL_MINISITE`,'
				. '`PROJ_IN_STATUS` '
				. ') VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

	const DEL_PK = 'DELETE ';
	const UPD = 'UPDATE `' . self::TABELA . '` set '
				. '`USUA_ID` = ?, '
				. '`PROJ_NM_NOME` = ?,'
				. '`PROJ_TX_EMAIL` = ?,'
				. '`PROJ_TX_PCHAVE` = ?,'
				. '`PROJ_TX_HEADLINE` = ?,'
				. '`PROJ_TX_PDIGITAL` = ?,'
				. '`PROJ_NM_NICHO` = ?,'
				. '`PROJ_NM_PROD` = ?,'
				. '`PROJ_TX_DESC_PROD` = ?,'
				. '`PROJ_TX_TIPO_PROD` = ?,'
				. '`PROJ_VL_PROD` = ?,'
				. '`PROJ_TX_HOTLNK` = ?,'
				. '`PROJ_TX_CHKLNK` = ?,'
				. '`PROJ_NM_AUTORIDADE` = ?,'
				. '`PROJ_TX_URL_MINISITE` = ?, '
				. '`PROJ_TX_BREVE_DESC` = ? ';

	const SELECT = 'SELECT `PROJ_ID`,'
					. ' `USUA_ID`,'
					. ' `PROJ_NM_NOME`,'
					. ' `PROJ_TX_EMAIL`,'
					. ' `PROJ_TX_PCHAVE`,'
					. ' `PROJ_TX_HEADLINE`,'
					. ' `PROJ_TX_PDIGITAL`,'
					. ' `PROJ_NM_NICHO`,'
					. ' `PROJ_NM_PROD`,'
					. ' `PROJ_TX_DESC_PROD`,'
					. ' `PROJ_TX_TIPO_PROD`,'
					. ' `PROJ_VL_PROD`,'
					. ' `PROJ_TX_HOTLNK`,'
					. ' `PROJ_TX_CHKLNK`,'
					. ' `PROJ_NM_AUTORIDADE`,'
					. ' `PROJ_TX_BREVE_DESC`,'
					. ' `PROJ_TX_URL_MINISITE`,'
					. ' `PROJ_IN_STATUS`,'
					. ' `PROJ_DT_CADASTRO`,'
					. ' `PROJ_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `PROJ_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `USUA_ID` = ?';
	const WHERE_ESPECIFICO = self::SELECT . ' WHERE `USUA_ID` = ? AND `PROJ_ID` = ?';

	const WHERE_UPD_PK = self::UPD . ' WHERE `PROJ_ID` = ?';

}
?>