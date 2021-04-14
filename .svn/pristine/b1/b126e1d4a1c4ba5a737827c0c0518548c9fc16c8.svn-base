<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlProjetoItens - DML para tabela
 */
class DmlSqlProjetoBeneficio extends DmlSql
{
	// Tabela
	const TABELA = 'PROJETO_BENEFICIOS';

	// colunas da tabela
	const PRBE_ID = 'PRBE_ID';
	const PROJ_ID = 'PROJ_ID';
	const PRBE_TX_BENEFICIO = 'PRBE_TX_BENEFICIO';
	const PRBE_DT_CADASTRO = 'PRBE_DT_CADASTRO';
	const PRBE_DT_UPDATE = 'PRBE_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `'.self::TABELA.'` ('
				. ' `PROJ_ID`,'
				. ' `PRBE_TX_BENEFICIO` '
				. ') VALUE (?,?)';

	const DEL_PK = 'DELETE from `'.self::TABELA.'` ';

	const UPD_PK = 'UPDATE ' ;
	const SELECT = 'SELECT `PRBE_ID`,'
					. ' `PROJ_ID`,'
					. ' `PRBE_TX_BENEFICIO`,'
					. ' `PRBE_DT_CADASTRO`,'
					. ' `PRBE_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const DEL_WHERE_PK = self::DEL_PK . ' WHERE `PRBE_ID` = ?';
	const WHERE_PK = self::SELECT . ' WHERE `PRBE_ID` = ?';
	const WHERE_PROJETOS = self::SELECT . ' WHERE `PROJ_ID` = ?';

}
?>

