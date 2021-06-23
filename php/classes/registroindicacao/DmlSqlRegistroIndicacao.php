<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlRegistroIndicacao - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLRegistroIndicacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um RegistroIndicacaoDTO, Array[]<RegistroIndicacaoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/06/2021 14:44:26
*
*/

class DmlSqlRegistroIndicacao extends DmlSql
{

    // Tabela
    const TABELA = 'REGISTRO_INDICACAO';

    // colunas da tabela
    const REIN_ID = 'REIN_ID';
    const USUA_ID_PROMOTOR = 'USUA_ID_PROMOTOR';
    const USUA_ID_INDICADO = 'USUA_ID_INDICADO';
    const REIN_IN_STATUS = 'REIN_IN_STATUS';
    const REIN_DT_CADASTRO = 'REIN_DT_CADASTRO';
    const REIN_DT_UPDATE = 'REIN_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID_PROMOTOR . '`, '
        . ' `' . self::USUA_ID_INDICADO . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::USUA_ID_PROMOTOR . '` = ?, '
    . ' `' . self::USUA_ID_INDICADO . '` = ?, '
    . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::REIN_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;

const SELECT_MAX_PK = 'SELECT MAX(REIN_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::REIN_ID . '`, ' 
        . ' `' . self::USUA_ID_PROMOTOR . '`, ' 
        . ' `' . self::USUA_ID_INDICADO . '`, ' 
        . ' `' . self::REIN_IN_STATUS . '`, ' 
        . ' `' . self::REIN_DT_CADASTRO . '`, ' 
        . ' `' . self::REIN_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_REGISTRO_INDICACAO_USUA_ID_PROMOTOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_PROMOTOR . '` = ? ' . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;
    const UPD_REGISTRO_INDICACAO_USUA_ID_INDICADO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_INDICADO . '` = ? ' . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;
    const UPD_REGISTRO_INDICACAO_REIN_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::REIN_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;
    const UPD_REGISTRO_INDICACAO_REIN_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::REIN_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;
    const UPD_REGISTRO_INDICACAO_REIN_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::REIN_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::REIN_ID . '` = ? ' ;
}
?>

