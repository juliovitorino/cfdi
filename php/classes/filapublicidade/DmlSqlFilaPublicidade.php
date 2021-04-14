<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlFilaPublicidade - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLFilaPublicidadeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um FilaPublicidadeDTO, Array[]<FilaPublicidadeDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 19/09/2019 15:31:07
*
*/

class DmlSqlFilaPublicidade extends DmlSql
{

    // Tabela
    const TABELA = 'FILA_PUBLICIDADE';

    // colunas da tabela
    const FIPU_ID = 'FIPU_ID';
    const USPU_ID = 'USPU_ID';
    const USUA_ID = 'USUA_ID';
    const JOBS_ID = 'JOBS_ID';
    const FIPU_IN_STATUS = 'FIPU_IN_STATUS';
    const FIPU_DT_CADASTRO = 'FIPU_DT_CADASTRO';
    const FIPU_DT_UPDATE = 'FIPU_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USPU_ID . '`, '
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::JOBS_ID . '` '
        . ') VALUES (?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USPU_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::JOBS_ID . '` = ? '
    . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FIPU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(FIPU_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::FIPU_ID . '`, ' 
        . ' `' . self::USPU_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::JOBS_ID . '`, ' 
        . ' `' . self::FIPU_IN_STATUS . '`, ' 
        . ' `' . self::FIPU_DT_CADASTRO . '`, ' 
        . ' `' . self::FIPU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_FILA_PUBLICIDADE_USPU_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_ID . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;
    const UPD_FILA_PUBLICIDADE_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;
    const UPD_FILA_PUBLICIDADE_JOBS_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::JOBS_ID . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;
    const UPD_FILA_PUBLICIDADE_FIPU_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIPU_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;
    const UPD_FILA_PUBLICIDADE_FIPU_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIPU_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;
    const UPD_FILA_PUBLICIDADE_FIPU_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIPU_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::FIPU_ID . '` = ? ' ;

}
?>
