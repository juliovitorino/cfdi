<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlRecurso - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLRecursoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um RecursoDTO, Array[]<RecursoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 08:00:49
*
*/

class DmlSqlRecurso extends DmlSql
{

    // Tabela
    const TABELA = 'RECURSO';

    // colunas da tabela
    const RECU_ID = 'RECU_ID';
    const RECU_TX_DESCRICAO = 'RECU_TX_DESCRICAO';
    const RECU_IN_STATUS = 'RECU_IN_STATUS';
    const RECU_DT_CADASTRO = 'RECU_DT_CADASTRO';
    const RECU_DT_UPDATE = 'RECU_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::RECU_TX_DESCRICAO . '` '
        . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::RECU_TX_DESCRICAO . '` = ? '
    . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::RECU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(RECU_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::RECU_ID . '`, ' 
        . ' `' . self::RECU_TX_DESCRICAO . '`, ' 
        . ' `' . self::RECU_IN_STATUS . '`, ' 
        . ' `' . self::RECU_DT_CADASTRO . '`, ' 
        . ' `' . self::RECU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_RECURSO_RECU_TX_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::RECU_TX_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;
    const UPD_RECURSO_RECU_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::RECU_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;
    const UPD_RECURSO_RECU_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::RECU_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;
    const UPD_RECURSO_RECU_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::RECU_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::RECU_ID . '` = ? ' ;



}
?>





