<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
* DmlSqlUf - DML para tabela
*/
class DmlSqlUf extends DmlSql
{

    // Tabela
    const TABELA = 'UF';

    // colunas da tabela
    const UF_ID = 'UF_ID';
    const UF_NM_ESTADO = 'UF_NM_ESTADO';
    const UF_IN_STATUS = 'UF_IN_STATUS';
    const UF_DT_CADASTRO = 'UF_DT_CADASTRO';
    const UF_DT_UPDATE = 'UF_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
    . ' `' . self::UF_NM_ESTADO . '`, '
    . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::UF_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::UF_NM_ESTADO . '` = ?, '
    . 'WHERE ' . ' `' . self::UF_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::UF_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::UF_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::UF_ID . '`, ' 
        . ' `' . self::UF_NM_ESTADO . '`, ' 
        . ' `' . self::UF_IN_STATUS . '`, ' 
        . ' `' . self::UF_DT_CADASTRO . '`, ' 
        . ' `' . self::UF_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

}

?>
