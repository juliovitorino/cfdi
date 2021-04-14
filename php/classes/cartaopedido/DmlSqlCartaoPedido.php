<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCartaoPedido - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCartaoPedidoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CartaoPedidoDTO, Array[]<CartaoPedidoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2019 14:08:07
*
*/

class DmlSqlCartaoPedido extends DmlSql
{

    // Tabela
    const TABELA = 'CARTAO_PEDIDO';

    // colunas da tabela
    const CAPE_ID = 'CAPE_ID';
    const CAMP_ID = 'CAMP_ID';
    const CAPE_TX_PEDIDO = 'CAPE_TX_PEDIDO';
    const CAPE_TX_HASH = 'CAPE_TX_HASH';
    const CAPE_NU_QTDE = 'CAPE_NU_QTDE';
    const CAPE_NU_SELOS = 'CAPE_NU_SELOS';
    const CAPE_VL_PEDIDO = 'CAPE_VL_PEDIDO';
    const CAPE_DT_AUTORIZACAO = 'CAPE_DT_AUTORIZACAO';
    const CAPE_DT_PGTO = 'CAPE_DT_PGTO';
    const CAPE_VL_PGTO = 'CAPE_VL_PGTO';
    const CAPE_TX_HASH_GATEWAY = 'CAPE_TX_HASH_GATEWAY';
    const CAPE_IN_TIPO = 'CAPE_IN_TIPO';
    const CAPE_IN_STATUS = 'CAPE_IN_STATUS';
    const CAPE_DT_CADASTRO = 'CAPE_DT_CADASTRO';
    const CAPE_DT_UPDATE = 'CAPE_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::CAPE_TX_PEDIDO . '`, '
        . ' `' . self::CAPE_TX_HASH . '`, '
        . ' `' . self::CAPE_NU_QTDE . '`, '
        . ' `' . self::CAPE_NU_SELOS . '`, '
        . ' `' . self::CAPE_VL_PEDIDO . '` '
        . ') VALUES (?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::CAPE_TX_PEDIDO . '` = ?, '
    . ' `' . self::CAPE_TX_HASH . '` = ?, '
    . ' `' . self::CAPE_NU_QTDE . '` = ?, '
    . ' `' . self::CAPE_NU_SELOS . '` = ?, '
    . ' `' . self::CAPE_VL_PEDIDO . '` = ?, '
    . ' `' . self::CAPE_DT_AUTORIZACAO . '` = ?, '
    . ' `' . self::CAPE_DT_PGTO . '` = ?, '
    . ' `' . self::CAPE_VL_PGTO . '` = ?, '
    . ' `' . self::CAPE_TX_HASH_GATEWAY . '` = ? '
    . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAPE_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CAPE_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CAPE_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::CAPE_TX_PEDIDO . '`, ' 
        . ' `' . self::CAPE_TX_HASH . '`, ' 
        . ' `' . self::CAPE_NU_QTDE . '`, ' 
        . ' `' . self::CAPE_NU_SELOS . '`, ' 
        . ' `' . self::CAPE_VL_PEDIDO . '`, ' 
        . ' `' . self::CAPE_DT_AUTORIZACAO . '`, ' 
        . ' `' . self::CAPE_DT_PGTO . '`, ' 
        . ' `' . self::CAPE_VL_PGTO . '`, ' 
        . ' `' . self::CAPE_TX_HASH_GATEWAY . '`, ' 
        . ' `' . self::CAPE_IN_TIPO . '`, ' 
        . ' `' . self::CAPE_IN_STATUS . '`, ' 
        . ' `' . self::CAPE_DT_CADASTRO . '`, ' 
        . ' `' . self::CAPE_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CARTAO_PEDIDO_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_TX_HASH_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_TX_HASH . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_NU_QTDE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_NU_QTDE . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_NU_SELOS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_NU_SELOS . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_VL_PEDIDO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_VL_PEDIDO . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_DT_AUTORIZACAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_DT_AUTORIZACAO . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_DT_PGTO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_DT_PGTO . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_VL_PGTO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_VL_PGTO . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_TX_HASH_GATEWAY_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_TX_HASH_GATEWAY . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;
    const UPD_CARTAO_PEDIDO_CAPE_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAPE_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CAPE_ID . '` = ? ' ;

}
?>
