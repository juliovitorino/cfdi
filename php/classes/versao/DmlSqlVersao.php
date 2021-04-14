<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlVersao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLVersaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um VersaoDTO, Array[]<VersaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/10/2019 15:59:51
*
*/

class DmlSqlVersao extends DmlSql
{

    // Tabela
    const TABELA = 'VERSAO';

    // colunas da tabela
    const VERS_ID = 'VERS_ID';
    const VERS_TX_VERSAO = 'VERS_TX_VERSAO';
    const VERS_IN_STATUS = 'VERS_IN_STATUS';
    const VERS_DT_CADASTRO = 'VERS_DT_CADASTRO';
    const VERS_DT_UPDATE = 'VERS_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::VERS_TX_VERSAO . '`, '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::VERS_TX_VERSAO . '` = ? '
    . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::VERS_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(VERS_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::VERS_ID . '`, ' 
        . ' `' . self::VERS_TX_VERSAO . '`, ' 
        . ' `' . self::VERS_IN_STATUS . '`, ' 
        . ' `' . self::VERS_DT_CADASTRO . '`, ' 
        . ' `' . self::VERS_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_VERSAO_VERS_TX_VERSAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::VERS_TX_VERSAO . '` = ? ' . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;
    const UPD_VERSAO_VERS_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::VERS_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;
    const UPD_VERSAO_VERS_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::VERS_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;
    const UPD_VERSAO_VERS_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::VERS_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::VERS_ID . '` = ? ' ;



}
?>





