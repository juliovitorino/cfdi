<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlMkdLista - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLMkdListaDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um MkdListaDTO, Array[]<MkdListaDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 04/11/2019 09:31:13
*
*/

class DmlSqlMkdLista extends DmlSql
{

    // Tabela
    const TABELA = 'MKD_EMAIL_LISTA';

    // colunas da tabela
    const MKEL_ID = 'MKEL_ID';
    const MKCE_ID = 'MKCE_ID';
    const MKEL_TX_NOME = 'MKEL_TX_NOME';
    const MKEL_TX_EMAIL = 'MKEL_TX_EMAIL';
    const MKEL_TX_PRIM_NOME = 'MKEL_TX_PRIM_NOME';
    const MKEL_TX_SOBRENOME = 'MKEL_TX_SOBRENOME';
    const MKEL_TX_WHATSAPP = 'MKEL_TX_WHATSAPP';
    const MKEL_TX_HASH = 'MKEL_TX_HASH';
    const MKEL_IN_STATUS = 'MKEL_IN_STATUS';
    const MKEL_DT_CADASTRO = 'MKEL_DT_CADASTRO';
    const MKEL_DT_UPDATE = 'MKEL_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::MKCE_ID . '`, '
        . ' `' . self::MKEL_TX_NOME . '`, '
        . ' `' . self::MKEL_TX_EMAIL . '`, '
        . ' `' . self::MKEL_TX_HASH . '` '
        . ') VALUES (?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::MKCE_ID . '` = ?, '
    . ' `' . self::MKEL_TX_NOME . '` = ?, '
    . ' `' . self::MKEL_TX_EMAIL . '` = ?, '
    . ' `' . self::MKEL_TX_PRIM_NOME . '` = ?, '
    . ' `' . self::MKEL_TX_SOBRENOME . '` = ?, '
    . ' `' . self::MKEL_TX_WHATSAPP . '` = ?, '
    . ' `' . self::MKEL_TX_HASH . '` = ? '
    . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::MKEL_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(MKEL_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::MKEL_ID . '`, ' 
        . ' `' . self::MKCE_ID . '`, ' 
        . ' `' . self::MKEL_TX_NOME . '`, ' 
        . ' `' . self::MKEL_TX_EMAIL . '`, ' 
        . ' `' . self::MKEL_TX_PRIM_NOME . '`, ' 
        . ' `' . self::MKEL_TX_SOBRENOME . '`, ' 
        . ' `' . self::MKEL_TX_WHATSAPP . '`, ' 
        . ' `' . self::MKEL_TX_HASH . '`, ' 
        . ' `' . self::MKEL_IN_STATUS . '`, ' 
        . ' `' . self::MKEL_DT_CADASTRO . '`, ' 
        . ' `' . self::MKEL_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_MKD_EMAIL_LISTA_MKCE_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKCE_ID . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_NOME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_NOME . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_EMAIL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_EMAIL . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_PRIM_NOME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_PRIM_NOME . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_SOBRENOME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_SOBRENOME . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_WHATSAPP_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_WHATSAPP . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_TX_HASH_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_TX_HASH . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;
    const UPD_MKD_EMAIL_LISTA_MKEL_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::MKEL_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::MKEL_ID . '` = ? ' ;

}
?>





