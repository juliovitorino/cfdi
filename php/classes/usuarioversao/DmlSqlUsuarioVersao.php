<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioVersao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioVersaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioVersaoDTO, Array[]<UsuarioVersaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/10/2019 16:44:47
*
*/

class DmlSqlUsuarioVersao extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_VERSAO';

    // colunas da tabela
    const USVE_ID = 'USVE_ID';
    const VERS_ID = 'VERS_ID';
    const USUA_ID = 'USUA_ID';
    const USVE_IN_STATUS = 'USVE_IN_STATUS';
    const USVE_DT_CADASTRO = 'USVE_DT_CADASTRO';
    const USVE_DT_UPDATE = 'USVE_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::VERS_ID . '`, '
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::VERS_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ? '
    . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USVE_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USVE_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::USVE_ID . '`, ' 
        . ' `' . self::VERS_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USVE_IN_STATUS . '`, ' 
        . ' `' . self::USVE_DT_CADASTRO . '`, ' 
        . ' `' . self::USVE_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_VERSAO_VERS_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::VERS_ID . '` = ? ' . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;
    const UPD_USUARIO_VERSAO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;
    const UPD_USUARIO_VERSAO_USVE_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USVE_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;
    const UPD_USUARIO_VERSAO_USVE_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USVE_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;
    const UPD_USUARIO_VERSAO_USVE_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USVE_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USVE_ID . '` = ? ' ;



}
?>
