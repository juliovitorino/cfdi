<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlSeloCuringa - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLSeloCuringaDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um SeloCuringaDTO, Array[]<SeloCuringaDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2019 11:13:11
*
*/

class DmlSqlSeloCuringa extends DmlSql
{

    // Tabela
    const TABELA = 'QRCODES_CURINGA';

    // colunas da tabela
    const QRCU_ID = 'QRCU_ID';
    const USUA_ID = 'USUA_ID';
    const CAMP_ID = 'CAMP_ID';
    const CART_ID = 'CART_ID';
    const USUA_AUTORIZACAO_ID = 'USUA_AUTORIZACAO_ID';
    const QRCU_TX_QRCODE = 'QRCU_TX_QRCODE';
    const QRCU_IN_STATUS = 'QRCU_IN_STATUS';
    const QRCU_DT_CADASTRO = 'QRCU_DT_CADASTRO';
    const QRCU_DT_UPDATE = 'QRCU_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::CART_ID . '`, '
        . ' `' . self::USUA_AUTORIZACAO_ID . '`, '
        . ' `' . self::QRCU_TX_QRCODE . '` '
        . ') VALUES (?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::QRCU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::CART_ID . '` = ?, '
    . ' `' . self::USUA_AUTORIZACAO_ID . '` = ?, '
    . ' `' . self::QRCU_TX_QRCODE . '` = ? '
    . 'WHERE ' . ' `' . self::QRCU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::QRCU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::QRCU_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::QRCU_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::CART_ID . '`, ' 
        . ' `' . self::USUA_AUTORIZACAO_ID . '`, ' 
        . ' `' . self::QRCU_TX_QRCODE . '`, ' 
        . ' `' . self::QRCU_IN_STATUS . '`, ' 
        . ' `' . self::QRCU_DT_CADASTRO . '`, ' 
        . ' `' . self::QRCU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

}
?>
