<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjetoTecnica - DML para tabela
 */
class DmlSqlProjetoTecnica extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO_TECNICAS';

	// colunas da tabela
	const PRTE_ID = 'PRTE_ID';
	const PROJ_ID = 'PROJ_ID';
	const PRTE_TX_TECNICAS = 'PRTE_TX_TECNICAS';
	const PRTE_DT_CADASTRO = 'PRTE_DT_CADASTRO';
	const PRTE_DT_UPDATE = 'PRTE_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
				. ' `PROJ_ID`,'
				. ' `PRTE_TX_TECNICAS` '
				. ') VALUE (?,?)';
				
	const DEL_PK = 'DELETE FROM `'.self::TABELA.'` '; 
	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `PRTE_ID`,'
					. ' `PROJ_ID`,'
					. ' `PRTE_TX_TECNICAS`,'
					. ' `PRTE_DT_CADASTRO`,'
					. ' `PRTE_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const DEL_WHERE_PK = self::DEL_PK . ' WHERE `PRTE_ID` = ?';
	const WHERE_PK = self::SELECT . ' WHERE `PRTE_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `PROJ_ID` = ?';

}
?>
