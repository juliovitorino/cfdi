<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaCashback - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaCashbackDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaCashbackDTO, Array[]<CampanhaCashbackDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 15:51:28
*
*/

class DmlSqlCampanhaCashback extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_CASHBACK';

    // colunas da tabela
    const CACA_ID = 'CACA_ID';
    const USCA_ID = 'USCA_ID';
    const CAMP_ID = 'CAMP_ID';
    const USUA_ID = 'USUA_ID';
    const CACA_VL_MIN = 'CACA_VL_MIN';
    const CACA_VL_PERC_CASHBACK = 'CACA_VL_PERC_CASHBACK';
    const CACA_DT_TERMINO = 'CACA_DT_TERMINO';
    const CACA_TX_OBS = 'CACA_TX_OBS';
    const CACA_IN_STATUS = 'CACA_IN_STATUS';
    const CACA_DT_CADASTRO = 'CACA_DT_CADASTRO';
    const CACA_DT_UPDATE = 'CACA_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::USCA_ID . '`, '
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::CACA_VL_PERC_CASHBACK . '`, '
        . ' `' . self::CACA_DT_TERMINO . '`, '
        . ' `' . self::CACA_TX_OBS . '` '
        . ') VALUES (?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::USCA_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::CACA_VL_PERC_CASHBACK . '` = ?, '
    . ' `' . self::CACA_DT_TERMINO . '` = ?, '
    . ' `' . self::CACA_TX_OBS . '` = ? '
    . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CACA_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::CACA_ID . '`, ' 
        . ' `' . self::USCA_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::CACA_VL_PERC_CASHBACK . '`, ' 
        . ' `' . self::CACA_DT_TERMINO . '`, ' 
        . ' `' . self::CACA_TX_OBS . '`, ' 
        . ' `' . self::CACA_IN_STATUS . '`, ' 
        . ' `' . self::CACA_DT_CADASTRO . '`, ' 
        . ' `' . self::CACA_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SELECT_MAX_PK = 'SELECT MAX(CACA_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_CASHBACK_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_USCA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_VL_PERC_CASHBACK_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_VL_PERC_CASHBACK . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_DT_TERMINO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_DT_TERMINO . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_TX_OBS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_TX_OBS . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CACA_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CACA_ID . '` = ? ' ;



}
?>





