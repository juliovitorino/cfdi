<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
* DmlSqlUsuarioComplemento - DML para tabela
*/
class DmlSqlUsuarioComplemento extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_COMPLEMENTO';

    // colunas da tabela
    const USCO_ID = 'USCO_ID';
    const USUA_ID = 'USUA_ID';
    const USCO_NM_RECEITA_FEDERAL = 'USCO_NM_RECEITA_FEDERAL';
    const USCO_TX_URL_WEBSITE = 'USCO_TX_URL_WEBSITE';
    const USCO_TX_URL_FACEBOOK = 'USCO_TX_URL_FACEBOOK';
    const USCO_TX_URL_INSTAGRAM = 'USCO_TX_URL_INSTAGRAM';
    const USCO_TX_URL_PINTEREST = 'USCO_TX_URL_PINTEREST';
    const USCO_TX_URL_SKYPE = 'USCO_TX_URL_SKYPE';
    const USCO_TX_URL_TWITTER = 'USCO_TX_URL_TWITTER';
    const USCO_TX_URL_FACETIME = 'USCO_TX_URL_FACETIME';
    const USCO_TX_URL_IMG1 = 'USCO_TX_URL_IMG1';
    const USCO_TX_URL_IMG2 = 'USCO_TX_URL_IMG2';
    const USCO_TX_URL_IMG3 = 'USCO_TX_URL_IMG3';
    const USCO_TX_DESC_LIVRE = 'USCO_TX_DESC_LIVRE';
    const USCO_IN_STATUS = 'USCO_IN_STATUS';
    const USCO_DT_CADASTRO = 'USCO_DT_CADASTRO';
    const USCO_DT_UPDATE = 'USCO_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USCO_NM_RECEITA_FEDERAL . '`, '
        . ' `' . self::USCO_TX_URL_WEBSITE . '`, '
        . ' `' . self::USCO_TX_URL_FACEBOOK . '`, '
        . ' `' . self::USCO_TX_URL_INSTAGRAM . '`, '
        . ' `' . self::USCO_TX_URL_PINTEREST . '`, '
        . ' `' . self::USCO_TX_URL_SKYPE . '`, '
        . ' `' . self::USCO_TX_URL_TWITTER . '`, '
        . ' `' . self::USCO_TX_URL_FACETIME . '`, '
        . ' `' . self::USCO_TX_URL_IMG1 . '`, '
        . ' `' . self::USCO_TX_URL_IMG2 . '`, '
        . ' `' . self::USCO_TX_URL_IMG3 . '`, '
        . ' `' . self::USCO_TX_DESC_LIVRE . '`, '
        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USCO_NM_RECEITA_FEDERAL . '` = ?, '
    . ' `' . self::USCO_TX_URL_WEBSITE . '` = ?, '
    . ' `' . self::USCO_TX_URL_FACEBOOK . '` = ?, '
    . ' `' . self::USCO_TX_URL_INSTAGRAM . '` = ?, '
    . ' `' . self::USCO_TX_URL_PINTEREST . '` = ?, '
    . ' `' . self::USCO_TX_URL_SKYPE . '` = ?, '
    . ' `' . self::USCO_TX_URL_TWITTER . '` = ?, '
    . ' `' . self::USCO_TX_URL_FACETIME . '` = ?, '
    . ' `' . self::USCO_TX_URL_IMG1 . '` = ?, '
    . ' `' . self::USCO_TX_URL_IMG2 . '` = ?, '
    . ' `' . self::USCO_TX_URL_IMG3 . '` = ?, '
    . ' `' . self::USCO_TX_DESC_LIVRE . '` = ?, '
    . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USCO_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::USCO_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USCO_NM_RECEITA_FEDERAL . '`, ' 
        . ' `' . self::USCO_TX_URL_WEBSITE . '`, ' 
        . ' `' . self::USCO_TX_URL_FACEBOOK . '`, ' 
        . ' `' . self::USCO_TX_URL_INSTAGRAM . '`, ' 
        . ' `' . self::USCO_TX_URL_PINTEREST . '`, ' 
        . ' `' . self::USCO_TX_URL_SKYPE . '`, ' 
        . ' `' . self::USCO_TX_URL_TWITTER . '`, ' 
        . ' `' . self::USCO_TX_URL_FACETIME . '`, ' 
        . ' `' . self::USCO_TX_URL_IMG1 . '`, ' 
        . ' `' . self::USCO_TX_URL_IMG2 . '`, ' 
        . ' `' . self::USCO_TX_URL_IMG3 . '`, ' 
        . ' `' . self::USCO_TX_DESC_LIVRE . '`, ' 
        . ' `' . self::USCO_IN_STATUS . '`, ' 
        . ' `' . self::USCO_DT_CADASTRO . '`, ' 
        . ' `' . self::USCO_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';
}

?>
