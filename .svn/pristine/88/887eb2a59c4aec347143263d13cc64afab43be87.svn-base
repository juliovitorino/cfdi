<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlMensagem - DML para tabela
 */
class DmlSqlMensagem extends DmlSql
{

	// Tabela
	const TABELA = 'MENSAGEM';

	// colunas da tabela
	const MENS_ID = 'MENS_ID';
	const MENS_TX_MSGCODE = 'MENS_TX_MSGCODE';
	const MENS_TX_MENSAGEM = 'MENS_TX_MENSAGEM';
	const MENS_IN_STATUS = 'MENS_IN_STATUS';
	const MENS_DT_CADASTRO = 'MENS_DT_CADASTRO';
	const MENS_DT_UPDATE = 'MENS_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO ';
	const DEL_PK = 'DELETE ';

	const UPD = 'UPDATE ';

	const SELECT = 'SELECT `MENS_ID`,'
					. ' `MENS_TX_MSGCODE`, '
					. ' `MENS_TX_MENSAGEM`, '
					. ' `MENS_IN_STATUS`, '
					. ' `MENS_DT_CADASTRO`,'
					. ' `MENS_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::MENS_ID . '` = ?';
	const WHERE_UIX = self::SELECT . ' WHERE `MENS_TX_MENSAGEM` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `MENS_IN_STATUS` = ?';

}
?>