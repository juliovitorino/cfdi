<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlGrupoAdministracao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLGrupoAdministracaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um GrupoAdministracaoDTO, Array[]<GrupoAdministracaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 15:50:27
*
*/

class DmlSqlGrupoAdministracao extends DmlSql
{

    // Tabela
    const TABELA = 'SEGLOG_GRUPO_ADMINISTRACAO';

    // colunas da tabela
    const GRAD_ID = 'GRAD_ID';
    const GRAD_NM_DESCRICAO = 'GRAD_NM_DESCRICAO';
    const GRAD_IN_STATUS = 'GRAD_IN_STATUS';
    const GRAD_DT_CADASTRO = 'GRAD_DT_CADASTRO';
    const GRAD_DT_UPDATE = 'GRAD_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::GRAD_NM_DESCRICAO . '` '
        . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GRAD_NM_DESCRICAO . '` = ? '
    . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GRAD_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(GRAD_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::GRAD_ID . '`, ' 
        . ' `' . self::GRAD_NM_DESCRICAO . '`, ' 
        . ' `' . self::GRAD_IN_STATUS . '`, ' 
        . ' `' . self::GRAD_DT_CADASTRO . '`, ' 
        . ' `' . self::GRAD_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_SEGLOG_GRUPO_ADMINISTRACAO_GRAD_NM_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_NM_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADMINISTRACAO_GRAD_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADMINISTRACAO_GRAD_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADMINISTRACAO_GRAD_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::GRAD_ID . '` = ? ' ;

}
?>
