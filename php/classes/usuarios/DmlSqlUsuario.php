<?php

// importar dependĂȘncias
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlUsuario - DML para tabela
 */
class DmlSqlUsuario extends DmlSql
{
	// Tabela
	const TABELA = 'USUARIO';

	const COLS = [
		'USUA_ID', //0
		'USUA_TX_EMAIL', //1
		'USUA_TX_NOME', //2
		'USUA_TX_SENHA', //3
		'USUA_IN_STATUS', //4 
		'USUA_DT_CADASTRO',//5
		'USUA_DT_UPDATE', //6
		'USUA_IN_TIPO_CONTA', //7
		'USUA_TX_CODIGO_ATIVACAO', //8
		'USUA_DT_CODIGO_ATIVACAO', //9
		'USUA_ID_USERFCBK', //10
		'USUA_TX_URLPICFCBK' //11
	];

	// colunas da tabela

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
					. '`' . self::COLS[1] .'`,'
 					. '`' . self::COLS[2] . '`,'
 					. '`' . self::COLS[3] . '`,'
 					. '`' . self::COLS[7] . '`,'
 					. '`' . self::COLS[8] . '` '
 					. ') VALUES (?,?,?,?,?)';

	const INS_FCBK = 'INSERT INTO `'.self::TABELA.'` ('
					. '`' . self::COLS[10] .'`,'
					. '`' . self::COLS[11] .'`,'
					. '`' . self::COLS[1] .'`,'
 					. '`' . self::COLS[2] .'`,'
 					. '`' . self::COLS[3] .'`,'
 					. '`' . self::COLS[4] .'`,'
 					. '`' . self::COLS[7] .'`,'
 					. '`' . self::COLS[8] .'`'
 					. ') VALUES (?,?,?,?,?,?,?,?)';

	const DEL_PK = 'DELETE ';
	const UPD_PK = 'UPDATE ' ;
	const UPD_STATUS_CHAVE_ATIVACAO = 'UPDATE `'.self::TABELA.'` SET `USUA_IN_STATUS` = ?,'
										. ' `USUA_DT_CODIGO_ATIVACAO` = CURRENT_TIMESTAMP'
										. ' WHERE `USUA_TX_CODIGO_ATIVACAO` = ?';

	const UPD_SENHA_POR_PK	 = 'UPDATE `'.self::TABELA.'` SET `USUA_TX_SENHA` = ? '
	. ' WHERE `USUA_ID` = ?';
	const UPD_FOTO_PERFIL_POR_PK = 'UPDATE `'.self::TABELA.'` SET `USUA_TX_URLPICFCBK` = ? '
	. ' WHERE `USUA_ID` = ?';
										
	const SELECT = 'SELECT ' 
					. ' `' . self::COLS[0] .'`,' 
					. ' `' . self::COLS[10] .'`,'
					. ' `' . self::COLS[1] .'`,'
					. ' `' . self::COLS[2] .'`,'
					. ' `' . self::COLS[3] .'`,'
					. ' `' . self::COLS[7] .'`,'
					. ' `' . self::COLS[11] .'`,'
					. ' `' . self::COLS[8] .'`,'
					. ' `' . self::COLS[9] .'`,'
  					. ' `' . self::COLS[4] .'`,'
					. ' `' . self::COLS[5] .'`,'
					. ' `' . self::COLS[6] .'` '
					. ' FROM `'.self::TABELA.'` ';
			
	const WHERE_PK = self::SELECT . ' WHERE `USUA_ID` = ?';
	const WHERE_EMAIL = self::SELECT . ' WHERE `USUA_TX_EMAIL` = ?';
	const WHERE_TOKEN_ATIVACAO = self::SELECT . ' WHERE `USUA_TX_CODIGO_ATIVACAO` = ?';
	


}
?>