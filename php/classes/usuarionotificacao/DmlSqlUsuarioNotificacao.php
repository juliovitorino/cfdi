<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioNotificacao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioNotificacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioNotificacaoDTO, Array[]<UsuarioNotificacaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 25/08/2019 16:16:12
*
*/

class DmlSqlUsuarioNotificacao extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_NOTIFICACAO';

    // colunas da tabela
    const USNO_ID = 'USNO_ID';
    const USUA_ID = 'USUA_ID';
    const USNO_TX_NOTIFICACAO = 'USNO_TX_NOTIFICACAO';
    const USNO_TX_ICON = 'USNO_TX_ICON';
    const USNO_TX_IMG = 'USNO_TX_IMG';
    const USNO_TX_BGCOLOR = 'USNO_TX_BGCOLOR';
    const USNO_IN_TIPO = 'USNO_IN_TIPO';
    const USNO_DT_PREV_APAGAR = 'USNO_DT_PREV_APAGAR';
    const USNO_TX_JSON = 'USNO_TX_JSON';
    const USNO_IN_STATUS = 'USNO_IN_STATUS';
    const USNO_DT_CADASTRO = 'USNO_DT_CADASTRO';
    const USNO_DT_UPDATE = 'USNO_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USNO_TX_NOTIFICACAO . '`, '
        . ' `' . self::USNO_IN_TIPO . '`, '
        . ' `' . self::USNO_TX_ICON . '`, '
        . ' `' . self::USNO_TX_JSON . '`, '
        . ' `' . self::USNO_DT_PREV_APAGAR . '` '
        . ') VALUES (?,?,?,?,?,DATE_ADD(CURRENT_DATE, INTERVAL 60 DAY))';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USNO_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USNO_TX_NOTIFICACAO . '` = ?, '
    . ' `' . self::USNO_TX_ICON . '` = ?, '
    . ' `' . self::USNO_TX_IMG . '` = ?, '
    . ' `' . self::USNO_TX_BGCOLOR . '` = ?, '
    . ' `' . self::USNO_IN_TIPO . '` = ?, '
    . ' `' . self::USNO_TX_JSON . '` = ?, '
    . ' `' . self::USNO_DT_PREV_APAGAR . '` = ? '
    . 'WHERE ' . ' `' . self::USNO_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USNO_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USNO_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::USNO_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USNO_TX_NOTIFICACAO . '`, ' 
        . ' `' . self::USNO_TX_ICON . '`, ' 
        . ' `' . self::USNO_TX_IMG . '`, ' 
        . ' `' . self::USNO_TX_BGCOLOR . '`, ' 
        . ' `' . self::USNO_IN_TIPO . '`, ' 
        . ' `' . self::USNO_DT_PREV_APAGAR . '`, ' 
        . ' `' . self::USNO_TX_JSON . '`, '
        . ' `' . self::USNO_IN_STATUS . '`, ' 
        . ' `' . self::USNO_DT_CADASTRO . '`, ' 
        . ' `' . self::USNO_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

}

?>
