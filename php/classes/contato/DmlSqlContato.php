<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlContato - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLContatoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um ContatoDTO, Array[]<ContatoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 31/08/2021 08:17:22
*
*/

class DmlSqlContato extends DmlSql
{

    // Tabela
    const TABELA = 'CONTATO';

    // colunas da tabela
    const CONT_ID = 'CONT_ID';
    const CONT_NM_NOME = 'CONT_NM_NOME';
    const CONT_TX_EMAIL = 'CONT_TX_EMAIL';
    const CONT_IN_ORIGEM = 'CONT_IN_ORIGEM';
    const CONT_TX_MENSAGEM = 'CONT_TX_MENSAGEM';
    const CONT_IN_STATUS = 'CONT_IN_STATUS';
    const CONT_DT_CADASTRO = 'CONT_DT_CADASTRO';
    const CONT_DT_UPDATE = 'CONT_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CONT_NM_NOME . '`, '
        . ' `' . self::CONT_TX_EMAIL . '`, '
        . ' `' . self::CONT_IN_ORIGEM . '`, '
        . ' `' . self::CONT_TX_MENSAGEM . '` '
        . ') VALUES (?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CONT_NM_NOME . '` = ?, '
    . ' `' . self::CONT_TX_EMAIL . '` = ?, '
    . ' `' . self::CONT_IN_ORIGEM . '` = ?, '
    . ' `' . self::CONT_TX_MENSAGEM . '` = ? '
    . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CONT_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CONT_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CONT_ID . '`, ' 
        . ' `' . self::CONT_NM_NOME . '`, ' 
        . ' `' . self::CONT_TX_EMAIL . '`, ' 
        . ' `' . self::CONT_IN_ORIGEM . '`, ' 
        . ' `' . self::CONT_TX_MENSAGEM . '`, ' 
        . ' `' . self::CONT_IN_STATUS . '`, ' 
        . ' `' . self::CONT_DT_CADASTRO . '`, ' 
        . ' `' . self::CONT_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CONTATO_CONT_NM_NOME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_NM_NOME . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;
    const UPD_CONTATO_CONT_TX_EMAIL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_TX_EMAIL . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;
    const UPD_CONTATO_CONT_TX_MENSAGEM_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_TX_MENSAGEM . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;
    const UPD_CONTATO_CONT_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;
    const UPD_CONTATO_CONT_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;
    const UPD_CONTATO_CONT_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CONT_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CONT_ID . '` = ? ' ;

}
?>

