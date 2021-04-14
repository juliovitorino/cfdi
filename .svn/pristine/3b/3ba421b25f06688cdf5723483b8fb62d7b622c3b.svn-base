<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlPlanoUsuarioFatura - DML para tabela
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */
class DmlSqlPlanoUsuarioFatura extends DmlSql
{

	// Tabela
	const TABELA = 'PLANO_USUARIO_FATURA';

	// colunas da tabela
	const PLUF_ID = 'PLUF_ID';
	const PLUF_ID_PARENT = 'PLUF_ID_PARENT';
	const PLUS_ID = 'PLUS_ID';
	const PLUF_VL_FATURA = 'PLUF_VL_FATURA';
	const PLUF_VL_DESCONTO = 'PLUF_VL_DESCONTO';
	const PLUF_DT_VENCIMENTO = 'PLUF_DT_VENCIMENTO';
	const PLUF_DT_PGTO = 'PLUF_DT_PGTO';
	const PLUF_IN_STATUS = 'PLUF_IN_STATUS';
	const PLUF_DT_CADASTRO = 'PLUF_DT_CADASTRO';
	const PLUF_DT_UPDATE = 'PLUF_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` '
					. '( `PLUS_ID`, '
					. ' `PLUF_VL_FATURA`, '
					. ' `PLUF_VL_DESCONTO`, '
					. ' `PLUF_DT_VENCIMENTO` '
					. ' ) VALUES (?,?,?,?)';

	const DEL_PK = 'DELETE ';

	const UPD = 'UPDATE ';
	const UPD_PK_APROVAR_PAGAMENTO = 'UPDATE  `' . self::TABELA . '` SET '
					. ' `PLUF_DT_PGTO` = CURRENT_TIMESTAMP, '
					. ' `PLUF_IN_STATUS` = ?'
 					. ' WHERE `' . self::PLUF_ID . '` = ?';

	const SELECT_MAX_PLUF_ID = 'SELECT max(`PLUF_ID`) FROM `' . self::TABELA . '` ';

	const SELECT = 'SELECT `PLUF_ID`,'
					. ' `PLUF_ID_PARENT`, '
					. ' `PLUS_ID`, '
					. ' `PLUF_VL_FATURA`, '
					. ' `PLUF_VL_DESCONTO`, '
					. ' `PLUF_DT_VENCIMENTO`, '
					. ' `PLUF_DT_PGTO`, '
					. ' `PLUF_IN_STATUS`, '
					. ' `PLUF_DT_CADASTRO`,'
					. ' `PLUF_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::PLUF_ID . '` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `PLUF_IN_STATUS` = ?';

}
?>
