<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlGrupoUsuario - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLGrupoUsuarioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um GrupoUsuarioDTO, Array[]<GrupoUsuarioDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/08/2021 17:02:50
*
*/

class DmlSqlGrupoUsuario extends DmlSql
{

    // Tabela
    const TABELA = 'SEGLOG_GRUPO_USUARIO';

    // colunas da tabela
    const GRUS_ID = 'GRUS_ID';
    const GRAD_ID = 'GRAD_ID';
    const USUA_ID = 'USUA_ID';
    const GRUS_IN_STATUS = 'GRUS_IN_STATUS';
    const GRUS_DT_CADASTRO = 'GRUS_DT_CADASTRO';
    const GRUS_DT_UPDATE = 'GRUS_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::GRAD_ID . '`, '
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GRAD_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ? '
    . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GRUS_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(GRUS_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::GRUS_ID . '`, ' 
        . ' `' . self::GRAD_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::GRUS_IN_STATUS . '`, ' 
        . ' `' . self::GRUS_DT_CADASTRO . '`, ' 
        . ' `' . self::GRUS_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_SEGLOG_GRUPO_USUARIO_GRAD_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_ID . '` = ? ' . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_USUARIO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_USUARIO_GRUS_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRUS_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_USUARIO_GRUS_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRUS_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_USUARIO_GRUS_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRUS_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::GRUS_ID . '` = ? ' ;

}
?>





