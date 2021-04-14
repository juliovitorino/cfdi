<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjetoDores - DML para tabela
 */
class DmlSqlProjetoDor extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO_DOR';

	// colunas da tabela
	const PRDO_ID = 'PRDO_ID';
	const PROJ_ID = 'PROJ_ID';
	const PRDO_TX_DOR = 'PRDO_TX_DOR';
	const PRDO_DT_CADASTRO = 'PRDO_DT_CADASTRO';
	const PRDO_DT_UPDATE = 'PRDO_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
				. ' `PROJ_ID`,'
				. ' `PRDO_TX_DOR` '
				. ') VALUE (?,?)';
	const DEL_PK = 'DELETE FROM `'.self::TABELA.'` ';
	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `PRDO_ID`,'
					. ' `PROJ_ID`,'
					. ' `PRDO_TX_DOR`,'
					. ' `PRDO_DT_CADASTRO`,'
					. ' `PRDO_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const DEL_WHERE_PK = self::DEL_PK . ' WHERE `PRDO_ID` = ?';
	const WHERE_PK = self::SELECT . ' WHERE `PRDO_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `PROJ_ID` = ?';

}

?>
