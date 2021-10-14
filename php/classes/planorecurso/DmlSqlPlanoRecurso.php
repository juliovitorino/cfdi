<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlPlanoRecurso - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLPlanoRecursoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um PlanoRecursoDTO, Array[]<PlanoRecursoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 12:12:30
*
*/

class DmlSqlPlanoRecurso extends DmlSql
{

    // Tabela
    const TABELA = 'PLANO_RECURSO';

    // colunas da tabela
    const PLRE_ID = 'PLRE_ID';
    const PLAN_ID = 'PLAN_ID';
    const RECU_ID = 'RECU_ID';
    const PLRE_IN_STATUS = 'PLRE_IN_STATUS';
    const PLRE_DT_CADASTRO = 'PLRE_DT_CADASTRO';
    const PLRE_DT_UPDATE = 'PLRE_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::PLAN_ID . '`, '
        . ' `' . self::RECU_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;
    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::PLAN_ID . '` = ?, '
    . ' `' . self::RECU_ID . '` = ? '
    . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::PLRE_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(PLRE_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::PLRE_ID . '`, ' 
        . ' `' . self::PLAN_ID . '`, ' 
        . ' `' . self::RECU_ID . '`, ' 
        . ' `' . self::PLRE_IN_STATUS . '`, ' 
        . ' `' . self::PLRE_DT_CADASTRO . '`, ' 
        . ' `' . self::PLRE_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_PLANO_RECURSO_PLAN_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_ID . '` = ? ' . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;
    const UPD_PLANO_RECURSO_RECU_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::RECU_ID . '` = ? ' . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;
    const UPD_PLANO_RECURSO_PLRE_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLRE_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;
    const UPD_PLANO_RECURSO_PLRE_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLRE_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;
    const UPD_PLANO_RECURSO_PLRE_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLRE_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::PLRE_ID . '` = ? ' ;

}
?>





