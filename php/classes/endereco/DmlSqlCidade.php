<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
* DmlSqlCidade - DML para tabela
*/
class DmlSqlCidade extends DmlSql
{

    // Tabela
    const TABELA = 'CIDADE';

    // colunas da tabela
    const CIDA_ID = 'CIDA_ID';
    const CIDA_NM_CIDADE = 'CIDA_NM_CIDADE';
    const CIDA_IN_STATUS = 'CIDA_IN_STATUS';
    const CIDA_DT_CADASTRO = 'CIDA_DT_CADASTRO';
    const CIDA_DT_UPDATE = 'CIDA_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CIDA_NM_CIDADE . '`, '
        . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CIDA_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CIDA_NM_CIDADE . '` = ?, '
    . 'WHERE ' . ' `' . self::CIDA_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CIDA_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CIDA_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::CIDA_ID . '`, ' 
        . ' `' . self::CIDA_NM_CIDADE . '`, ' 
        . ' `' . self::CIDA_IN_STATUS . '`, ' 
        . ' `' . self::CIDA_DT_CADASTRO . '`, ' 
        . ' `' . self::CIDA_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

}

?>

