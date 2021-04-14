<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
 * DmlSqlVariavel - DML para tabela
 */
class DmlSqlVariavel extends DmlSql
{
	// Tabela
	const TABELA = 'VARIAVEL';

	// colunas da tabela
	const VARI_ID = 'VARI_ID';
	const VARI_NM_VARIAVEL = 'VARI_NM_VARIAVEL';
	const VARI_TX_DESCRICAO = 'VARI_TX_DESCRICAO';
	const VARI_TX_VALOR_CONTEUDO = 'VARI_TX_VALOR_CONTEUDO';
	const VARI_IN_STATUS = 'VARI_IN_STATUS';
	const VARI_DT_CADASTRO = 'VARI_DT_CADASTRO';
	const VARI_DT_UPDATE = 'VARI_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO ';
	const DEL_PK = 'DELETE ';

	const UPD = 'UPDATE ';

	const SELECT = 'SELECT `VARI_ID`,'
					. ' `VARI_NM_VARIAVEL`, '
					. ' `VARI_TX_DESCRICAO`, '
					. ' `VARI_TX_VALOR_CONTEUDO`, '
					. ' `VARI_IN_STATUS`, '
					. ' `VARI_DT_CADASTRO`,'
					. ' `VARI_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::VARI_ID . '` = ?';
	const WHERE_UIX = self::SELECT . ' WHERE `VARI_NM_VARIAVEL` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `VARI_IN_STATUS` = ?';

}
?>