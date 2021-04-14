<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlTrace - DML para tabela
 */
class DmlSqlTrace extends DmlSql
{

	// Tabela
	const TABELA = 'TRACE';

	// colunas da tabela
	const COLS = ['TRAC_ID',
				'TRAC_IN_TIPO',
				'TRAC_TX_DESC',
				'TRAC_IN_STATUS',
				'TRAC_DT_CADASTRO',
				'TRAC_DT_UPDATE'
				];

	// Comandos DML
	const SQL_INS = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::COLS[1] . '`, ' 
		. ' `' . self::COLS[2] . '` ' 
		. ') VALUES (?,?)';

	const SQL_DEL_PK = 'DELETE * from `' . self::TABELA . '` ' .
	'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD = 'UPDATE `' . self::TABELA . '` set ';
	const SQL_UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[5] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_SELECT = 'SELECT ' 
		. ' `' . self::COLS[0] . '`, ' 
		. ' `' . self::COLS[1] . '`, ' 
		. ' `' . self::COLS[2] . '`, ' 
		. ' `' . self::COLS[3] . '`, ' 
		. ' `' . self::COLS[4] . '`, ' 
		. ' `' . self::COLS[5] . '` ' 
		. ' FROM `'.self::TABELA.'` ';


}
?>