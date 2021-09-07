<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioComplemento - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioComplementoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioComplementoDTO, Array[]<UsuarioComplementoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 07/09/2021 11:00:05
*
*/

class DmlSqlUsuarioComplemento extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_COMPLEMENTO';

    // colunas da tabela
    const USCO_ID = 'USCO_ID';
    const USUA_ID = 'USUA_ID';
    const USCO_TX_DDD = 'USCO_TX_DDD';
    const USCO_TX_CEL = 'USCO_TX_CEL';
    const USCO_NM_RECEITA_FEDERAL = 'USCO_NM_RECEITA_FEDERAL';
    const USCO_NM_RESPONSAVEL = 'USCO_NM_RESPONSAVEL';
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
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?)';
/*
    const INS_FULL = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USCO_TX_DDD . '`, '
        . ' `' . self::USCO_TX_CEL . '`, '
        . ' `' . self::USCO_NM_RECEITA_FEDERAL . '`, '
        . ' `' . self::USCO_NM_RESPONSAVEL . '`, '
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
        . ' `' . self::USCO_TX_DESC_LIVRE . '` '
        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?)';


*/
    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USCO_TX_DDD . '` = ?, '
    . ' `' . self::USCO_TX_CEL . '` = ?, '
    . ' `' . self::USCO_NM_RECEITA_FEDERAL . '` = ?, '
    . ' `' . self::USCO_NM_RESPONSAVEL . '` = ?, '
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
    . ' `' . self::USCO_TX_DESC_LIVRE . '` = ? '
    . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USCO_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USCO_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::USCO_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USCO_TX_DDD . '`, ' 
        . ' `' . self::USCO_TX_CEL . '`, ' 
        . ' `' . self::USCO_NM_RECEITA_FEDERAL . '`, ' 
        . ' `' . self::USCO_NM_RESPONSAVEL . '`, ' 
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

    const UPD_USUARIO_COMPLEMENTO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_DDD_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_DDD . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_CEL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_CEL . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_NM_RECEITA_FEDERAL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_NM_RECEITA_FEDERAL . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_NM_RESPONSAVEL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_NM_RESPONSAVEL . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_WEBSITE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_WEBSITE . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_FACEBOOK_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_FACEBOOK . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_INSTAGRAM_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_INSTAGRAM . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_PINTEREST_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_PINTEREST . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_SKYPE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_SKYPE . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_TWITTER_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_TWITTER . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_FACETIME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_FACETIME . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG1_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_IMG1 . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG2_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_IMG2 . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG3_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_URL_IMG3 . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_TX_DESC_LIVRE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_TX_DESC_LIVRE . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;
    const UPD_USUARIO_COMPLEMENTO_USCO_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCO_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USCO_ID . '` = ? ' ;



}
?>

