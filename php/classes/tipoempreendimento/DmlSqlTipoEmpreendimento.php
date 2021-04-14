<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlTipoEmpreendimento - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLTipoEmpreendimentoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um TipoEmpreendimentoDTO, Array[]<TipoEmpreendimentoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2019 09:14:23
*
*/

class DmlSqlTipoEmpreendimento extends DmlSql
{

    // Tabela
    const TABELA = 'TIPO_EMPREENDIMENTO';

    // colunas da tabela
    const TIEM_ID = 'TIEM_ID';
    const TIEM_TX_DESCRICAO = 'TIEM_TX_DESCRICAO';
    const TIEM_TX_IMG = 'TIEM_TX_IMG';
    const TIEM_IN_STATUS = 'TIEM_IN_STATUS';
    const TIEM_DT_CADASTRO = 'TIEM_DT_CADASTRO';
    const TIEM_DT_UPDATE = 'TIEM_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::TIEM_TX_DESCRICAO . '`, '
        . ' `' . self::TIEM_TX_IMG . '`, '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::TIEM_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::TIEM_TX_DESCRICAO . '` = ?, '
    . ' `' . self::TIEM_TX_IMG . '` = ? '
    . 'WHERE ' . ' `' . self::TIEM_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::TIEM_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::TIEM_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::TIEM_ID . '`, ' 
        . ' `' . self::TIEM_TX_DESCRICAO . '`, ' 
        . ' `' . self::TIEM_TX_IMG . '`, ' 
        . ' `' . self::TIEM_IN_STATUS . '`, ' 
        . ' `' . self::TIEM_DT_CADASTRO . '`, ' 
        . ' `' . self::TIEM_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

}








?>





