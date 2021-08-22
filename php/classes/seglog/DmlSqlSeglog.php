<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlSeglog - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLSeglogDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um SeglogDTO, Array[]<SeglogDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 21/08/2021 12:30:09
*
*/

class DmlSqlSeglog extends DmlSql
{

    // Tabela
    const TABELA = 'VW_SEGLOG';

    // colunas da tabela
    const SELOG_ID = 'SELOG_ID';
    const USUA_ID = 'USUA_ID';
    const SEGLOG_DESCRICAO = 'SEGLOG_DESCRICAO';
    const SEGLOG_IN_CRUD_CRIAR = 'SEGLOG_IN_CRUD_CRIAR';
    const SEGLOG_IN_CRUD_RECUPERAR = 'SEGLOG_IN_CRUD_RECUPERAR';
    const SEGLOG_IN_CRUD_ATUALIZAR = 'SEGLOG_IN_CRUD_ATUALIZAR';
    const SEGLOG_IN_CRUD_EXCLUIR = 'SEGLOG_IN_CRUD_EXCLUIR';
    const SEGLOG_IN_STATUS = 'SEGLOG_IN_STATUS';
    const SEGLOG_DT_CADASTRO = 'SEGLOG_DT_CADASTRO';
    const SEGLOG_DT_UPDATE = 'SEGLOG_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::SEGLOG_DESCRICAO . '`, '
        . ' `' . self::SEGLOG_IN_CRUD_CRIAR . '`, '
        . ' `' . self::SEGLOG_IN_CRUD_RECUPERAR . '`, '
        . ' `' . self::SEGLOG_IN_CRUD_ATUALIZAR . '`, '
        . ' `' . self::SEGLOG_IN_CRUD_EXCLUIR . '`, '
        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::SEGLOG_DESCRICAO . '` = ?, '
    . ' `' . self::SEGLOG_IN_CRUD_CRIAR . '` = ?, '
    . ' `' . self::SEGLOG_IN_CRUD_RECUPERAR . '` = ?, '
    . ' `' . self::SEGLOG_IN_CRUD_ATUALIZAR . '` = ?, '
    . ' `' . self::SEGLOG_IN_CRUD_EXCLUIR . '` = ?, '
    . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::SEGLOG_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(SELOG_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::SELOG_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::SEGLOG_DESCRICAO . '`, ' 
        . ' `' . self::SEGLOG_IN_CRUD_CRIAR . '`, ' 
        . ' `' . self::SEGLOG_IN_CRUD_RECUPERAR . '`, ' 
        . ' `' . self::SEGLOG_IN_CRUD_ATUALIZAR . '`, ' 
        . ' `' . self::SEGLOG_IN_CRUD_EXCLUIR . '`, ' 
        . ' `' . self::SEGLOG_IN_STATUS . '`, ' 
        . ' `' . self::SEGLOG_DT_CADASTRO . '`, ' 
        . ' `' . self::SEGLOG_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_VW_SEGLOG_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_IN_CRUD_CRIAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_IN_CRUD_CRIAR . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_IN_CRUD_RECUPERAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_IN_CRUD_RECUPERAR . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_IN_CRUD_ATUALIZAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_IN_CRUD_ATUALIZAR . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_IN_CRUD_EXCLUIR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_IN_CRUD_EXCLUIR . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;
    const UPD_VW_SEGLOG_SEGLOG_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::SEGLOG_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::SELOG_ID . '` = ? ' ;

}
?>
