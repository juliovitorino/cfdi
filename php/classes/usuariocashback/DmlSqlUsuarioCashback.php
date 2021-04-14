<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioCashback - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioCashbackDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioCashbackDTO, Array[]<UsuarioCashbackDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2019 08:43:34
*
*/

class DmlSqlUsuarioCashback extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_CASHBACK';

    // colunas da tabela
    const USCA_ID = 'USCA_ID';
    const USUA_ID = 'USUA_ID';
    const USCA_VL_RESGATE = 'USCA_VL_RESGATE';
    const USCA_VL_PERC_CASHBACK = 'USCA_VL_PERC_CASHBACK';
    const USCA_TX_OBS = 'USCA_TX_OBS';
    const USCA_NU_CONT_STAR_1 = 'USCA_NU_CONT_STAR_1';
    const USCA_NU_CONT_STAR_2 = 'USCA_NU_CONT_STAR_2';
    const USCA_NU_CONT_STAR_3 = 'USCA_NU_CONT_STAR_3';
    const USCA_NU_CONT_STAR_4 = 'USCA_NU_CONT_STAR_4';
    const USCA_NU_CONT_STAR_5 = 'USCA_NU_CONT_STAR_5';
    const USCA_NU_RATING = 'USCA_NU_RATING';
    const USCA_IN_STATUS = 'USCA_IN_STATUS';
    const USCA_DT_CADASTRO = 'USCA_DT_CADASTRO';
    const USCA_DT_UPDATE = 'USCA_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USCA_VL_RESGATE . '`, '
        . ' `' . self::USCA_VL_PERC_CASHBACK . '`, '
        . ' `' . self::USCA_TX_OBS . '` '
        . ') VALUES (?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USCA_VL_RESGATE . '` = ?, '
    . ' `' . self::USCA_VL_PERC_CASHBACK . '` = ?, '
    . ' `' . self::USCA_TX_OBS . '` = ?, '
    . ' `' . self::USCA_NU_CONT_STAR_1 . '` = ?, '
    . ' `' . self::USCA_NU_CONT_STAR_2 . '` = ?, '
    . ' `' . self::USCA_NU_CONT_STAR_3 . '` = ?, '
    . ' `' . self::USCA_NU_CONT_STAR_4 . '` = ?, '
    . ' `' . self::USCA_NU_CONT_STAR_5 . '` = ?, '
    . ' `' . self::USCA_NU_RATING . '` = ? '
    . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USCA_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;

const SELECT_MAX_PK = 'SELECT MAX(USCA_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::USCA_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USCA_VL_RESGATE . '`, ' 
        . ' `' . self::USCA_VL_PERC_CASHBACK . '`, ' 
        . ' `' . self::USCA_TX_OBS . '`, ' 
        . ' `' . self::USCA_NU_CONT_STAR_1 . '`, ' 
        . ' `' . self::USCA_NU_CONT_STAR_2 . '`, ' 
        . ' `' . self::USCA_NU_CONT_STAR_3 . '`, ' 
        . ' `' . self::USCA_NU_CONT_STAR_4 . '`, ' 
        . ' `' . self::USCA_NU_CONT_STAR_5 . '`, ' 
        . ' `' . self::USCA_NU_RATING . '`, ' 
        . ' `' . self::USCA_IN_STATUS . '`, ' 
        . ' `' . self::USCA_DT_CADASTRO . '`, ' 
        . ' `' . self::USCA_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_CASHBACK_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_VL_RESGATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_VL_RESGATE . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_VL_PERC_CASHBACK_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_VL_PERC_CASHBACK . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_TX_OBS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_TX_OBS . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_1_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_CONT_STAR_1 . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_2_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_CONT_STAR_2 . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_3_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_CONT_STAR_3 . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_4_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_CONT_STAR_4 . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_5_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_CONT_STAR_5 . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_NU_RATING_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_NU_RATING . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
    const UPD_USUARIO_CASHBACK_USCA_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCA_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USCA_ID . '` = ? ' ;
}
?>
