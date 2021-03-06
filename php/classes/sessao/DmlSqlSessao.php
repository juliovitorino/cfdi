<?php

// importar dependĂȘncias
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlSessao - DML para tabela
 */
class DmlSqlSessao extends DmlSql
{
	// Tabela e campos
	const TABELA = 'SESSAO';

	// colunas da tabela
	const SESS_ID = 'SESS_ID';
	const SESS_TX_HASH = 'SESS_TX_HASH';
	const USUA_ID = 'USUA_ID';
	const SESS_IN_MANTER_CONECTADO = 'SESS_IN_MANTER_CONECTADO';
	const SESS_IN_FORCAR_LOGIN = 'SESS_IN_FORCAR_LOGIN';
	const SESS_IN_STATUS = 'SESS_IN_STATUS';
	const SESS_DT_CADASTRO = 'SESS_DT_CADASTRO';
	const SESS_DT_UPDATE = 'SESS_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` (`SESS_TX_HASH`, `USUA_ID`, `SESS_IN_MANTER_CONECTADO`) VALUES (?,?,?)';
	
	const DEL_PK = 'DELETE ';
	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `SESS_ID`,' 
					. ' `SESS_TX_HASH`,'
					. ' `USUA_ID`,'
					. ' `SESS_IN_MANTER_CONECTADO`,'
					. ' `SESS_IN_FORCAR_LOGIN`,'
					. ' `SESS_IN_STATUS`,'
					. ' `SESS_DT_CADASTRO`,'
					. ' `SESS_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `SESS_ID` = ?';
	const WHERE_TOKEN = self::SELECT . ' WHERE `SESS_TX_HASH` = ?';

}
?>