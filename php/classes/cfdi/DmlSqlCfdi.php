<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlCfdi - DML para tabela
 */
class DmlSqlCfdi extends DmlSql
{

	// Tabela
	const TABELA = 'CFDI';

	// colunas da tabela
	const COLS = ['CFDI_ID', //0
				'CAMP_ID',//1
				'USUA_ID',//2
				'CFDI_TX_QRCODE_REGIST',//3
				'CFDI_IN_MODO',//4
				'CFDI_IN_STATUS',//5
				'CFDI_DT_CADASTRO',//6
				'CFDI_DT_UPDATE',//7
				'CFDI_VL_TICKET_MEDIO',//8
				'USUA_ID_GERADOR' //9
				];

	// Comandos DML
	const SQL_INS = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::COLS[1] . '`, ' 
		. ' `' . self::COLS[2] . '`, ' 
		. ' `' . self::COLS[3] . '`, ' 
		. ' `' . self::COLS[4] . '`, ' 
		. ' `' . self::COLS[5] . '`, ' 
		. ' `' . self::COLS[8] . '`, ' 
		. ' `' . self::COLS[9] . '` ' 
		. ') VALUES (?,?,?,?,?,?,?)';

	const SQL_DEL_PK = 'DELETE * from `' . self::TABELA . '` ' .
	'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD = 'UPDATE `' . self::TABELA . '` set ';
	const SQL_UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[5] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_USUA_ID_GERADOR = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[9] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[3] . '` = ? ' ;

	const SQL_SELECT = 'SELECT ' 
		. ' `' . self::COLS[0] . '`, ' 
		. ' `' . self::COLS[1] . '`, ' 
		. ' `' . self::COLS[2] . '`, ' 
		. ' `' . self::COLS[3] . '`, ' 
		. ' `' . self::COLS[4] . '`, ' 
		. ' `' . self::COLS[5] . '`, ' 
		. ' `' . self::COLS[6] . '`, ' 
		. ' `' . self::COLS[7] . '`, ' 
		. ' `' . self::COLS[8] . '`, ' 
		. ' `' . self::COLS[9] . '` ' 
		. ' FROM `'.self::TABELA.'` ';


}
?>