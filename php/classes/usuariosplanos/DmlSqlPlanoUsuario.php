<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlPlanoUsuario - DML para tabela
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 19/08/2018
 */
class DmlSqlPlanoUsuario extends DmlSql
{

	// Tabela
	const TABELA = 'PLANO_USUARIO';

	// colunas da tabela
	const PLUS_ID = 'PLUS_ID';
	const PLUS_ID_PARENT = 'PLUS_ID_PARENT';
	const USUA_ID = 'USUA_ID';
	const PLAN_ID = 'PLAN_ID';
	const PLUS_NM_PLANO = 'PLUS_NM_PLANO';
	const PLUS_TX_PERMISSAO = 'PLUS_TX_PERMISSAO';
	const PLUS_VL_PLANO = 'PLUS_VL_PLANO';
	const PLUS_IN_STATUS = 'PLUS_IN_STATUS';
	const PLUS_DT_CADASTRO = 'PLUS_DT_CADASTRO';
	const PLUS_DT_UPDATE = 'PLUS_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO ' . self::TABELA
					. '( `USUA_ID`, '
					. ' `PLAN_ID`, '
					. ' `PLUS_NM_PLANO`, '
					. ' `PLUS_TX_PERMISSAO`, '
					. ' `PLUS_VL_PLANO` '					
					. ' ) VALUES (?,?,?,?,?)';

	const DEL_PK = 'DELETE ';
	const UPD = 'UPDATE  ';
	const UPD_STATUS = 'UPDATE  `' . self::TABELA . '` SET `PLUS_IN_STATUS` = ?';

	const SELECT = 'SELECT `PLUS_ID`,'
					. ' `PLUS_ID_PARENT`, '
					. ' `USUA_ID`, '
					. ' `PLAN_ID`, '
					. ' `PLUS_NM_PLANO`, '
					. ' `PLUS_TX_PERMISSAO`, '
					. ' `PLUS_VL_PLANO`, '
					. ' `PLUS_IN_STATUS`, '
					. ' `PLUS_DT_CADASTRO`,'
					. ' `PLUS_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const SELECT_MAX_PLUS_ID = 'SELECT max(`PLUS_ID`) FROM `' . self::TABELA . '` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::PLUS_ID . '` = ?';
	const WHERE_PK_UPD_STATUS = self::UPD_STATUS . ' WHERE `' . self::PLUS_ID . '` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `PLUS_IN_STATUS` = ?';


}
?>
