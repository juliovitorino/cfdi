<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioAvaliacao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioAvaliacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioAvaliacaoDTO, Array[]<UsuarioAvaliacaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2019 09:22:19
*
*/

class DmlSqlUsuarioAvaliacao extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_AVALIACAO';

    // colunas da tabela
    const USAV_ID = 'USAV_ID';
    const USUA_ID = 'USUA_ID';
    const USAV_NU_CONT_STAR_1 = 'USAV_NU_CONT_STAR_1';
    const USAV_NU_CONT_STAR_2 = 'USAV_NU_CONT_STAR_2';
    const USAV_NU_CONT_STAR_3 = 'USAV_NU_CONT_STAR_3';
    const USAV_NU_CONT_STAR_4 = 'USAV_NU_CONT_STAR_4';
    const USAV_NU_CONT_STAR_5 = 'USAV_NU_CONT_STAR_5';
    const USAV_NU_RATING = 'USAV_NU_RATING';
    const USAV_IN_STATUS = 'USAV_IN_STATUS';
    const USAV_DT_CADASTRO = 'USAV_DT_CADASTRO';
    const USAV_DT_UPDATE = 'USAV_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USAV_NU_CONT_STAR_1 . '` = ?, '
    . ' `' . self::USAV_NU_CONT_STAR_2 . '` = ?, '
    . ' `' . self::USAV_NU_CONT_STAR_3 . '` = ?, '
    . ' `' . self::USAV_NU_CONT_STAR_4 . '` = ?, '
    . ' `' . self::USAV_NU_CONT_STAR_5 . '` = ?, '
    . ' `' . self::USAV_NU_RATING . '` = ? '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_USAV_NU_CONT_STAR_1 = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_NU_CONT_STAR_1 . '` = `' . self::USAV_NU_CONT_STAR_1 . '`+ 1 '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_USAV_NU_CONT_STAR_2 = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_NU_CONT_STAR_2 . '` = `' . self::USAV_NU_CONT_STAR_2 . '`+ 1 '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_USAV_NU_CONT_STAR_3 = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_NU_CONT_STAR_3 . '` = `' . self::USAV_NU_CONT_STAR_3 . '`+ 1 '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_USAV_NU_CONT_STAR_4 = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_NU_CONT_STAR_4 . '` = `' . self::USAV_NU_CONT_STAR_4 . '`+ 1 '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const UPD_USAV_NU_CONT_STAR_5 = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAV_NU_CONT_STAR_5 . '` = `' . self::USAV_NU_CONT_STAR_5 . '`+ 1 '
    . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USAV_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::USAV_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USAV_NU_CONT_STAR_1 . '`, ' 
        . ' `' . self::USAV_NU_CONT_STAR_2 . '`, ' 
        . ' `' . self::USAV_NU_CONT_STAR_3 . '`, ' 
        . ' `' . self::USAV_NU_CONT_STAR_4 . '`, ' 
        . ' `' . self::USAV_NU_CONT_STAR_5 . '`, ' 
        . ' `' . self::USAV_NU_RATING . '`, ' 
        . ' `' . self::USAV_IN_STATUS . '`, ' 
        . ' `' . self::USAV_DT_CADASTRO . '`, ' 
        . ' `' . self::USAV_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_AVALIACAO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_1_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_CONT_STAR_1 . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_2_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_CONT_STAR_2 . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_3_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_CONT_STAR_3 . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_4_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_CONT_STAR_4 . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_5_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_CONT_STAR_5 . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_NU_RATING_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_NU_RATING . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;
    const UPD_USUARIO_AVALIACAO_USAV_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAV_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USAV_ID . '` = ? ' ;



}
?>





