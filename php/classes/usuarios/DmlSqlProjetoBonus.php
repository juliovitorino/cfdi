<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjeto - DML para tabela
 */
class DmlSqlProjetoBonus extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO_BONUS';

	// colunas da tabela
	const PRBO_ID = 'PRBO_ID';
	const PROJ_ID = 'PROJ_ID';
	const PRBO_TX_BONUS = 'PRBO_TX_BONUS';
	const PRBO_DT_CADASTRO = 'PRBO_DT_CADASTRO';
	const PRBO_DT_UPDATE = 'PRBO_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
				. ' `PROJ_ID`,'
				. ' `PRBO_TX_BONUS` '
				. ') VALUE (?,?)';
	
	const DEL_PK = 'DELETE FROM `'.self::TABELA.'` ';

	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `PRBO_ID`,'
					. ' `PROJ_ID`,'
					. ' `PRBO_TX_BONUS`,'
					. ' `PRBO_DT_CADASTRO`,'
					. ' `PRBO_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const DEL_WHERE_PK = self::DEL_PK . ' WHERE `PRBO_ID` = ?';
	const WHERE_PK = self::SELECT . ' WHERE `PRBO_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `PROJ_ID` = ?';

}
?>