<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaSorteioFilaCriacao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaSorteioFilaCriacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaSorteioFilaCriacaoDTO, Array[]<CampanhaSorteioFilaCriacaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 08:10:22
*
*/

class DmlSqlCampanhaSorteioFilaCriacao extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_SORTEIO_FILA_CRIACAO';

    // colunas da tabela
    const CSFC_ID = 'CSFC_ID';
    const CASO_ID = 'CASO_ID';
    const CSFC_QT_LOTE = 'CSFC_QT_LOTE';
    const CSFC_IN_STATUS = 'CSFC_IN_STATUS';
    const CSFC_DT_CADASTRO = 'CSFC_DT_CADASTRO';
    const CSFC_DT_UPDATE = 'CSFC_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::CASO_ID . '`, '
        . ' `' . self::CSFC_QT_LOTE . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::CASO_ID . '` = ?, '
    . ' `' . self::CSFC_QT_LOTE . '` = ?, '
    . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CSFC_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CSFC_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::CSFC_ID . '`, ' 
        . ' `' . self::CASO_ID . '`, ' 
        . ' `' . self::CSFC_QT_LOTE . '`, ' 
        . ' `' . self::CSFC_IN_STATUS . '`, ' 
        . ' `' . self::CSFC_DT_CADASTRO . '`, ' 
        . ' `' . self::CSFC_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CASO_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_ID . '` = ? ' . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CSFC_QT_LOTE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSFC_QT_LOTE . '` = ? ' . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CSFC_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSFC_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CSFC_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSFC_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CSFC_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSFC_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CSFC_ID . '` = ? ' ;
}
?>

