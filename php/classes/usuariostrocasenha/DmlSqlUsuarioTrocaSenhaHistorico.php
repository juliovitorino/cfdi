<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlUsuarioTrocaSenhaHistorico - DML para tabela
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 25/08/2018
 */
class DmlSqlUsuarioTrocaSenhaHistorico extends DmlSql
{

	// Tabela
	const TABELA = 'USUARIO_TROCA_SENHA_HISTORICO';

	// colunas da tabela
	const UTSH_ID = 'UTSH_ID';
	const USUA_ID = 'USUA_ID';
	const UTSH_TX_TOKEN = 'UTSH_TX_TOKEN';
	const UTSH_IN_STATUS = 'UTSH_IN_STATUS';
	const UTSH_DT_CADASTRO = 'UTSH_DT_CADASTRO';
	const UTSH_DT_UPDATE = 'UTSH_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` '
					. '( `USUA_ID`, '
					. ' `UTSH_TX_TOKEN` '
					. ' ) VALUES (?,?)';

	const DEL_PK = 'DELETE ';


	const DEL_TOKEN_STATUS = 'DELETE FROM `'.self::TABELA.'` '
	 				. ' WHERE `' . self::UTSH_TX_TOKEN . '` = ?'
	 				. ' AND `' . self::UTSH_IN_STATUS . '` = ?';

	const DEL_USUA_ID_STATUS = 'DELETE FROM `'.self::TABELA.'` '
	 				. ' WHERE `' . self::USUA_ID . '` = ?'
	 				. ' AND `' . self::UTSH_IN_STATUS . '` = ?';
 				
	const UPD_PK_STATUS = 'UPDATE `'.self::TABELA.'` SET '
					. ' `UTSH_IN_STATUS` = ? '
	 				. ' WHERE `' . self::UTSH_ID . '` = ?';

	const UPD_USUA_ID_STATUS = 'UPDATE `'.self::TABELA.'` SET '
					. ' `UTSH_IN_STATUS` = ? '
	 				. ' WHERE `' . self::USUA_ID . '` = ?'
	 				. ' AND `' . self::UTSH_IN_STATUS . '` = ?';

	const SELECT = 'SELECT `UTSH_ID`,'
					. ' `USUA_ID`, '
					. ' `UTSH_TX_TOKEN`, '
					. ' `UTSH_IN_STATUS`, '
					. ' `UTSH_DT_CADASTRO`,'
					. ' `UTSH_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::UTSH_ID . '` = ?';
	const WHERE_TOKEN = self::SELECT . ' WHERE `' . self::UTSH_TX_TOKEN . '` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `UTSH_IN_STATUS` = ?';

}
?>
