<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlPlano - DML para tabela
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 18/08/2018
 */
class DmlSqlPlano extends DmlSql
{

	// Tabela
	const TABELA = 'PLANOS';

	// colunas da tabela
	const PLAN_ID = 'PLAN_ID';
	const PLAN_NM_PLANO = 'PLAN_NM_PLANO';
	const PLAN_TX_PERMISSAO = 'PLAN_TX_PERMISSAO';
	const PLAN_VL_PLANO = 'PLAN_VL_PLANO';
	const PLAN_IN_TIPO = 'PLAN_IN_TIPO';
	const PLAN_IN_STATUS = 'PLAN_IN_STATUS';
	const PLAN_DT_CADASTRO = 'PLAN_DT_CADASTRO';
	const PLAN_DT_UPDATE = 'PLAN_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO ';
	const DEL_PK = 'DELETE ';
	const UPD = 'UPDATE ';

	const SELECT = 'SELECT `PLAN_ID`,'
					. ' `PLAN_NM_PLANO`, '
					. ' `PLAN_TX_PERMISSAO`, '
					. ' `PLAN_VL_PLANO`, '
					. ' `PLAN_IN_TIPO`, '
					. ' `PLAN_IN_STATUS`, '
					. ' `PLAN_DT_CADASTRO`,'
					. ' `PLAN_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::PLAN_ID . '` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `PLAN_IN_STATUS` = ?';

}
?>
