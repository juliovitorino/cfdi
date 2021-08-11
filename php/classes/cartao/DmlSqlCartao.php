<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlCartao - DML para tabela
 */
class DmlSqlCartao extends DmlSql
{

	// Tabela
	const TABELA = 'CARTAO';

	// colunas da tabela
	const COLS = ['CART_ID', //0
				'CAMP_ID', //1
				'USUA_ID', //2
				'CART_NU_CONTADOR', //3
				'CART_IN_STATUS', //4
				'CART_DT_CADASTRO', //5
				'CART_DT_UPDATE', //6
				'CART_TX_CFDI_CARIMBOS', //7
				'CART_IN_FAVORITO', //8
				'CART_TX_HASH_RESGATE', //9
				'CART_DT_COMPLETOU' , //10
				'CART_DT_VALIDOU' , //11
				'CART_DT_ENTREGOU_REC' , //12
				'CART_DT_CONFIRM_RECEBEU', //13
				'CART_IN_LIKE', //14
				'CART_IN_RATING', //15
				'CART_TX_COMENT', //16
				'CART_DT_RATING', //17
				'QRCU_ID', //18
				];

	// Comandos DML
	const SQL_INS = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::COLS[1] . '`, ' 
		. ' `' . self::COLS[2] . '`, ' 
		. ' `' . self::COLS[9] . '` ' 
		. ') VALUES (?,?,?)';

	const SQL_DEL_PK = 'DELETE * from `' . self::TABELA . '` ' .
	'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD = 'UPDATE `' . self::TABELA . '` set ';

	const SQL_UPD_USUA_ID = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[2] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[4] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_FAVORITO = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[8] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_LIKE = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[14] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_RATING_COMENT = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[17] . '` = CURRENT_TIMESTAMP ,'
	. ' `' . self::COLS[15] . '` = ? ,'
	. ' `' . self::COLS[16] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_INCREMENTA_CONTADOR = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[3] . '` = ' . ' `' . self::COLS[3] . '` + 1, '
	. ' `' . self::COLS[7] . '` = ? '
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_CART_DT_COMPLETOU = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[10] . '` = CURRENT_TIMESTAMP ' 
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_CART_DT_VALIDOU = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[11] . '` = CURRENT_TIMESTAMP ' 
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_CART_DT_ENTREGOU_REC = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[12] . '` = CURRENT_TIMESTAMP ' 
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_UPD_CART_DT_CONFIRM_RECEBEU = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::COLS[13] . '` = CURRENT_TIMESTAMP ' 
	. 'WHERE ' . ' `' . self::COLS[0] . '` = ? ' ;

	const SQL_COUNT = 'SELECT COUNT(*) AS contador '
	. ' FROM `'.self::TABELA.'` ';

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
		. ' `' . self::COLS[9] . '`, ' 
		. ' `' . self::COLS[10] . '`, ' 
		. ' `' . self::COLS[11] . '`, ' 
		. ' `' . self::COLS[12] . '`, ' 
		. ' `' . self::COLS[13] . '`, ' 
		. ' `' . self::COLS[14] . '`, ' 
		. ' `' . self::COLS[15] . '`, ' 
		. ' `' . self::COLS[16] . '`, ' 
		. ' `' . self::COLS[17] . '`, ' 
		. ' `' . self::COLS[18] . '` ' 
		. ' FROM `'.self::TABELA.'` ';


}
?>