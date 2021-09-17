<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlCampanhaQrCode - DML para tabela
 */
class DmlSqlCampanhaQrCode extends DmlSql
{

	// Tabela
	const TABELA = 'CAMPANHA_QRCODES';

	// colunas da tabela
	const CAQR_ID = 'CAQR_ID';
	const CAMP_ID = 'CAMP_ID';
	const CAQR_TX_QRCODE = 'CAQR_TX_QRCODE';
	const CAQR_TX_TICKET = 'CAQR_TX_TICKET';
	const CAQR_ID_PARENT = 'CAQR_ID_PARENT';
	const CAQR_NU_ORDER = 'CAQR_NU_ORDER';
	const USUA_ID_GERADOR = 'USUA_ID_GERADOR';
	const CAQR_IN_STATUS = 'CAQR_IN_STATUS';
	const CAQR_DT_CADASTRO = 'CAQR_DT_CADASTRO';
	const CAQR_DT_UPDATE = 'CAQR_DT_UPDATE';


	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::CAQR_ID . '`, ' 
		. ' `' . self::CAMP_ID . '`, ' 
		. ' `' . self::CAQR_TX_QRCODE . '`, ' 
		. ' `' . self::CAQR_TX_TICKET . '`, ' 
		. ' `' . self::CAQR_IN_STATUS . '`, ' 
		. ' `' . self::CAQR_ID_PARENT . '`, ' 
		. ' `' . self::CAQR_NU_ORDER . '`, ' 
		. ' `' . self::USUA_ID_GERADOR . '` ' 
		. ') VALUES (?,?,?,?,?,?,?,?)';

	const DEL_PK = 'DELETE * from `' . self::TABELA . '` ' .
	'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

	const UPD = 'UPDATE `' . self::TABELA . '` set ';
	
	const UPD_STATUS_POR_TICKET = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAQR_IN_STATUS . '` = ? '
	. 'WHERE ' . ' `' . self::CAQR_TX_TICKET . '` = ? ' ;

	const UPD_STATUS_POR_CARIMBOQR = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAQR_IN_STATUS . '` = ? '
	. 'WHERE ' . ' `' . self::CAQR_TX_QRCODE . '` = ? ' ;

	const UPD_USUA_ID_GERADOR = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::USUA_ID_GERADOR . '` = ? '
	. 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

	const SELECT = 'SELECT ' 
		. ' `' . self::CAQR_ID . '`, ' 
		. ' `' . self::CAMP_ID . '`, ' 
		. ' `' . self::CAQR_TX_QRCODE . '`, ' 
		. ' `' . self::CAQR_NU_ORDER . '`, ' 
		. ' `' . self::CAQR_TX_TICKET . '`, ' 
		. ' `' . self::CAQR_ID_PARENT . '`, '
		. ' `' . self::USUA_ID_GERADOR . '`, '
		. ' `' . self::CAQR_IN_STATUS . '`, '
		. ' `' . self::CAQR_DT_CADASTRO . '`, '
		. ' `' . self::CAQR_DT_UPDATE . '` '
		. ' FROM `'.self::TABELA.'` ';

		
	const SQL_COUNT = 'SELECT COUNT(*) AS contador '
	. ' FROM `'.self::TABELA.'` ';

	const UPD_CAMPANHA_QRCODES_CAQR_ID_PARENT_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_ID_PARENT . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_TX_QRCODE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_TX_QRCODE . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_NU_ORDER_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_NU_ORDER . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_TX_TICKET_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_TX_TICKET . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_USUA_ID_GERADOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_GERADOR . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
	const UPD_CAMPANHA_QRCODES_CAQR_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

	

}
?>