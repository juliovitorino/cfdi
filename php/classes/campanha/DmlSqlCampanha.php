<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlCampanha - DML para tabela
 */
class DmlSqlCampanha extends DmlSql
{

	// Tabela
	const TABELA = 'CAMPANHA';

	// colunas da tabela
	const CAMP_ID = 'CAMP_ID';
	const USUA_ID = 'USUA_ID';
	const CAMP_TX_NOME = 'CAMP_TX_NOME';
	const CAMP_TX_EXPLICATIVO = 'CAMP_TX_EXPLICATIVO';
	const CAMP_DT_INICIO = 'CAMP_DT_INICIO';
	const CAMP_DT_TERMINO = 'CAMP_DT_TERMINO';
	const CAMP_NU_MAX_CARTAO = 'CAMP_NU_MAX_CARTAO';
	const CAMP_NU_MIN_DELAY = 'CAMP_NU_MIN_DELAY';
	const CAMP_TX_QRCODE_ATIVO = 'CAMP_TX_QRCODE_ATIVO';
	const CAMP_TX_FRASE_EFEITO = 'CAMP_TX_FRASE_EFEITO';
	const CAMP_TX_RECOMPENSA = 'CAMP_TX_RECOMPENSA';
	const CAMP_IN_STATUS = 'CAMP_IN_STATUS';
	const CAMP_DT_CADASTRO = 'CAMP_DT_CADASTRO';
	const CAMP_DT_UPDATE = 'CAMP_DT_UPDATE';
	const CAMP_ID_PROXIMO_CAQR_ID = 'CAMP_ID_PROXIMO_CAQR_ID';
	const CAMP_TT_CARIMBOS = 'CAMP_TT_CARIMBOS';
	const CAMP_TT_CARIMBADOS = 'CAMP_TT_CARIMBADOS';
	const CAMP_NU_MAX_SELOS = 'CAMP_NU_MAX_SELOS';
	const CAMP_VL_TICKET_MEDIO = 'CAMP_VL_TICKET_MEDIO';
	const CAMP_VL_ACM_TICKET = 'CAMP_VL_ACM_TICKET';
	const CAMP_IN_UPD_MAX_SELOS = 'CAMP_IN_UPD_MAX_SELOS';
	const CAMP_TX_AGRADECIMENTO = 'CAMP_TX_AGRADECIMENTO';
	const CAMP_NU_CONT_CARTAO = 'CAMP_NU_CONT_CARTAO';
    const CAMP_TX_IMG = 'CAMP_TX_IMG';
	const CAMP_TX_IMG_RECOMPENSA = 'CAMP_TX_IMG_RECOMPENSA';
	const CAMP_NU_LIKE = 'CAMP_NU_LIKE';
	const CAMP_NU_CONT_STAR_1 = 'CAMP_NU_CONT_STAR_1';
	const CAMP_NU_CONT_STAR_2 = 'CAMP_NU_CONT_STAR_2';
	const CAMP_NU_CONT_STAR_3 = 'CAMP_NU_CONT_STAR_3';
	const CAMP_NU_CONT_STAR_4 = 'CAMP_NU_CONT_STAR_4';
	const CAMP_NU_CONT_STAR_5 = 'CAMP_NU_CONT_STAR_5';
	const CAMP_NU_RATING = 'CAMP_NU_RATING';
	const CAMP_IN_CURINGA = 'CAMP_IN_CURINGA';
	const CAMP_IN_CASHBACK = 'CAMP_IN_CASHBACK';
	const CAMP_IN_PERM_CSJ10 = 'CAMP_IN_PERM_CSJ10';

	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::USUA_ID . '`, ' 
		. ' `' . self::CAMP_TX_NOME . '`, ' 
		. ' `' . self::CAMP_TX_EXPLICATIVO . '`, ' 
		. ' `' . self::CAMP_DT_INICIO . '`, ' 
		. ' `' . self::CAMP_DT_TERMINO . '`, ' 
		. ' `' . self::CAMP_NU_MAX_CARTAO . '`, ' 
		. ' `' . self::CAMP_NU_MIN_DELAY . '`, ' 
		. ' `' . self::CAMP_TX_QRCODE_ATIVO . '`, ' 
		. ' `' . self::CAMP_IN_STATUS . '`, '
		. ' `' . self::CAMP_TX_FRASE_EFEITO . '`, '
		. ' `' . self::CAMP_TX_RECOMPENSA . '` '
		. ') VALUES (?,?,?,?,?,?,?,?,?,?,?)';

	const INS_FLASH = 'INSERT INTO `' . self::TABELA . '` ('
		. ' `' . self::USUA_ID . '`, ' 
		. ' `' . self::CAMP_TX_NOME . '`, ' 
		. ' `' . self::CAMP_TX_EXPLICATIVO . '`, ' 
		. ' `' . self::CAMP_DT_INICIO . '`, ' 
		. ' `' . self::CAMP_DT_TERMINO . '`, ' 
		. ' `' . self::CAMP_NU_MAX_CARTAO . '`, ' 
		. ' `' . self::CAMP_NU_MIN_DELAY . '`, ' 
		. ' `' . self::CAMP_TX_QRCODE_ATIVO . '`, ' 
		. ' `' . self::CAMP_IN_STATUS . '`, '
		. ' `' . self::CAMP_TX_FRASE_EFEITO . '`, '
		. ' `' . self::CAMP_TX_RECOMPENSA . '`, '
		. ' `' . self::CAMP_TX_AGRADECIMENTO . '`, '
		. ' `' . self::CAMP_TX_IMG . '`, '
		. ' `' . self::CAMP_TX_IMG_RECOMPENSA . '` '
		. ") VALUES (?,?,?,CURRENT_TIMESTAMP,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 YEAR),?,?,?,?,?,?,?,?,?)";

	const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
	'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_TX_NOME . '` = ?, '
	. ' `' . self::CAMP_TX_EXPLICATIVO . '` = ?, '
	. ' `' . self::CAMP_DT_INICIO . '` = ?, '
	. ' `' . self::CAMP_DT_TERMINO . '` = ?, '
	//. ' `' . self::CAMP_NU_MAX_CARTAO . '` = ?, '
	. ' `' . self::CAMP_TX_FRASE_EFEITO . '` = ?, '
	. ' `' . self::CAMP_TX_RECOMPENSA . '` = ?, '
	. ' `' . self::CAMP_NU_MAX_SELOS . '` = ?, '
	. ' `' . self::CAMP_VL_TICKET_MEDIO . '` = ?, '
	. ' `' . self::CAMP_TX_AGRADECIMENTO . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_IN_STATUS . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_CAMP_IN_CASHBACK = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_IN_CASHBACK . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_IMAGEM_CAMPANHA = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_TX_IMG . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_CAMP_IN_UPD_MAX_SELOS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_IN_UPD_MAX_SELOS . '` = ' . "'" . ConstantesVariavel::STATUS_NEGADO . "'" 
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_PROXIMO_QRCODE = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_ID_PROXIMO_CAQR_ID . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_TOTAL_CARIMBOS_FABRICADOS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_TT_CARIMBOS . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_ADD_TOTAL_CARIMBOS_FABRICADOS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_TT_CARIMBOS . '` = `' . self::CAMP_TT_CARIMBOS . '` + ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;
	

	const UPD_ADD_CAMP_NU_MAX_CARTAO_FABRICADOS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_MAX_CARTAO . '` = `' . self::CAMP_NU_MAX_CARTAO . '` + ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_TOTAL_CARIMBADOS = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_TT_CARIMBADOS . '` = '
	. ' `' . self::CAMP_TT_CARIMBADOS . '` + 1 '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_NU_LIKE_INC = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_LIKE . '` = '
	. ' `' . self::CAMP_NU_LIKE . '` + 1 '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_NU_LIKE_DEC = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_LIKE . '` = '
	. ' `' . self::CAMP_NU_LIKE . '` - 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ' 
	. ' AND `' . self::CAMP_NU_LIKE . '` > 0 ';

	const UPD_NU_CONT_CARTAO = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_CARTAO . '` = '
	. ' `' . self::CAMP_NU_CONT_CARTAO . '` + 1 '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_VL_ACM_TICKET = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_VL_ACM_TICKET . '` = '
	. ' `' . self::CAMP_VL_ACM_TICKET . '` + ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_PROXIMO_CAQR_ID = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_ID_PROXIMO_CAQR_ID . '` = ? '
	. 'WHERE ' . ' `' . self::CAMP_ID . '` = ? ' ;

	const UPD_CAMP_NU_CONT_STAR_1 = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_STAR_1 . '` = '
	. ' `' . self::CAMP_NU_CONT_STAR_1 . '` + 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const UPD_CAMP_NU_CONT_STAR_2 = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_STAR_2 . '` = '
	. ' `' . self::CAMP_NU_CONT_STAR_2 . '` + 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const UPD_CAMP_NU_CONT_STAR_3 = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_STAR_3 . '` = '
	. ' `' . self::CAMP_NU_CONT_STAR_3 . '` + 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const UPD_CAMP_NU_CONT_STAR_4 = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_STAR_4 . '` = '
	. ' `' . self::CAMP_NU_CONT_STAR_4 . '` + 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const UPD_CAMP_NU_CONT_STAR_5 = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_CONT_STAR_5 . '` = '
	. ' `' . self::CAMP_NU_CONT_STAR_5 . '` + 1 '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const UPD_CAMP_NU_RATING = 'UPDATE `' . self::TABELA . '` set '
	. ' `' . self::CAMP_NU_RATING . '` = ? '
	. 'WHERE `' . self::CAMP_ID . '` = ? ';
	
	const SELECT = 'SELECT ' 
		. ' `' . self::CAMP_ID . '`, ' 
		. ' `' . self::USUA_ID . '`, ' 
		. ' `' . self::CAMP_TX_NOME . '`, ' 
		. ' `' . self::CAMP_TX_EXPLICATIVO . '`, ' 
		. ' `' . self::CAMP_TX_AGRADECIMENTO . '`, ' 
		. ' `' . self::CAMP_DT_INICIO . '`, ' 
		. ' `' . self::CAMP_DT_TERMINO . '`, ' 
		. ' `' . self::CAMP_NU_MAX_CARTAO . '`, '
		. ' `' . self::CAMP_NU_CONT_CARTAO . '`, ' 
		. ' `' . self::CAMP_NU_MAX_SELOS . '`, ' 
		. ' `' . self::CAMP_IN_UPD_MAX_SELOS . '`, ' 
		. ' `' . self::CAMP_IN_PERM_CSJ10 . '`, ' 
		. ' `' . self::CAMP_NU_MIN_DELAY . '`, ' 
		. ' `' . self::CAMP_TX_QRCODE_ATIVO . '`, ' 
		. ' `' . self::CAMP_TX_FRASE_EFEITO . '`, ' 
		. ' `' . self::CAMP_TX_RECOMPENSA . '`, ' 
		. ' `' . self::CAMP_ID_PROXIMO_CAQR_ID . '`, ' 
		. ' `' . self::CAMP_TT_CARIMBOS . '`, ' 
		. ' `' . self::CAMP_TT_CARIMBADOS . '`, ' 
		. ' `' . self::CAMP_VL_TICKET_MEDIO . '`, ' 
		. ' `' . self::CAMP_VL_ACM_TICKET . '`, ' 
		. ' `' . self::CAMP_TX_IMG . '`, ' 
		. ' `' . self::CAMP_TX_IMG_RECOMPENSA . '`, ' 
		. ' `' . self::CAMP_NU_LIKE . '`, ' 
		. ' `' . self::CAMP_NU_CONT_STAR_1 . '`, ' 
		. ' `' . self::CAMP_NU_CONT_STAR_2 . '`, ' 
		. ' `' . self::CAMP_NU_CONT_STAR_3 . '`, ' 
		. ' `' . self::CAMP_NU_CONT_STAR_4 . '`, ' 
		. ' `' . self::CAMP_NU_CONT_STAR_5 . '`, ' 
		. ' `' . self::CAMP_NU_RATING . '`, ' 
		. ' `' . self::CAMP_IN_CURINGA . '`, ' 
		. ' `' . self::CAMP_IN_CASHBACK . '`, ' 
		. ' `' . self::CAMP_IN_STATUS . '`, '
		. ' `' . self::CAMP_DT_CADASTRO . '`, '
		. ' `' . self::CAMP_DT_UPDATE . '` '
		. ' FROM `'.self::TABELA.'` ';

	const SELECT_ULT_CAMP_ID = 'SELECT MAX(`' . self::CAMP_ID . '`) AS `MAX_CAMP_ID` ' 
		. ' FROM `'.self::TABELA.'` ';


	const SQL_COUNT = 'SELECT COUNT(*) AS contador '
	. ' FROM `'.self::TABELA.'` ';
   

}
?>