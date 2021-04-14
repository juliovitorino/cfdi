<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjetoItens - DML para tabela
 */
class DmlSqlProjetoItens extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO_ITEM';

	// colunas da tabela
	const PRIT_ID = 'PRIT_ID';
	const PROJ_ID = 'PROJ_ID';
	const PRIT_TX_ITEM = 'PRIT_TX_ITEM';
	const PRIT_DT_CADASTRO = 'PRIT_DT_CADASTRO';
	const PRIT_DT_UPDATE = 'PRIT_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
				. ' `PROJ_ID`,'
				. ' `PRIT_TX_ITEM` '
				. ') VALUE (?,?)';

	const DEL_PK = 'DELETE from `'.self::TABELA.'` ';
	
	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `PRIT_ID`,'
					. ' `PROJ_ID`,'
					. ' `PRIT_TX_ITEM`,'
					. ' `PRIT_DT_CADASTRO`,'
					. ' `PRIT_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';



	const DEL_WHERE_PK = self::DEL_PK . ' WHERE `PRIT_ID` = ?';
	const WHERE_PK = self::SELECT . ' WHERE `PRIT_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `PROJ_ID` = ?';

}
?>