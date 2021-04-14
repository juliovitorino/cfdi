<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioAutorizador - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioAutorizadorDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioAutorizadorDTO, Array[]<UsuarioAutorizadorDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2019 12:52:36
*
*/

class DmlSqlUsuarioAutorizador extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_AUTORIZADOR';

    // colunas da tabela
    const USAU_ID = 'USAU_ID';
    const USUA_ID = 'USUA_ID';
    const USUA_ID_AUTORIZADOR = 'USUA_ID_AUTORIZADOR';
    const CAMP_ID = 'CAMP_ID';
    const USAU_IN_TIPO = 'USAU_IN_TIPO';
    const USAU_IN_AUTORIZACAO = 'USAU_IN_AUTORIZACAO';
    const USAU_DT_INICIO = 'USAU_DT_INICIO';
    const USAU_DT_TERMINO = 'USAU_DT_TERMINO';
    const USAU_IN_STATUS = 'USAU_IN_STATUS';
    const USAU_DT_CADASTRO = 'USAU_DT_CADASTRO';
    const USAU_DT_UPDATE = 'USAU_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USUA_ID_AUTORIZADOR . '`, '
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::USAU_IN_TIPO . '`, '
        . ' `' . self::USAU_IN_AUTORIZACAO . '`, '
        . ' `' . self::USAU_DT_INICIO . '`, '
        . ' `' . self::USAU_DT_TERMINO . '` '
        . ') VALUES (?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAU_IN_TIPO . '` = ?, '
    . ' `' . self::USAU_IN_AUTORIZACAO . '` = ?, '
    . ' `' . self::USAU_DT_INICIO . '` = ?, '
    . ' `' . self::USAU_DT_TERMINO . '` = ? '
    . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USAU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USAU_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::USAU_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USUA_ID_AUTORIZADOR . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::USAU_IN_TIPO . '`, ' 
        . ' `' . self::USAU_IN_AUTORIZACAO . '`, ' 
        . ' `' . self::USAU_DT_INICIO . '`, ' 
        . ' `' . self::USAU_DT_TERMINO . '`, ' 
        . ' `' . self::USAU_IN_STATUS . '`, ' 
        . ' `' . self::USAU_DT_CADASTRO . '`, ' 
        . ' `' . self::USAU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_AUTORIZADOR_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USUA_ID_AUTORIZADOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_AUTORIZADOR . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_IN_TIPO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_IN_TIPO . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_IN_AUTORIZACAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_IN_AUTORIZACAO . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_DT_INICIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_DT_INICIO . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_DT_TERMINO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_DT_TERMINO . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
    const UPD_USUARIO_AUTORIZADOR_USAU_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USAU_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USAU_ID . '` = ? ' ;
}
?>

