<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlFundoParticipacaoGlobal - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLFundoParticipacaoGlobalDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um FundoParticipacaoGlobalDTO, Array[]<FundoParticipacaoGlobalDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 18/08/2021 12:15:16
*
*/

class DmlSqlFundoParticipacaoGlobal extends DmlSql
{

    // Tabela
    const TABELA = 'FUNDO_PARTICIPACAO_GLOBAL';

    // colunas da tabela
    const FPGL_ID = 'FPGL_ID';
    const USUA_ID = 'USUA_ID';
    const USUA_ID_BONIFICADO = 'USUA_ID_BONIFICADO';
    const PLUF_ID = 'PLUF_ID';
    const FPGL_IN_TIPO = 'FPGL_IN_TIPO';
    const FPGL_VL_TRANSACAO = 'FPGL_VL_TRANSACAO';
    const FPGL_TX_DESCRICAO = 'FPGL_TX_DESCRICAO';
    const FPGL_IN_STATUS = 'FPGL_IN_STATUS';
    const FPGL_DT_CADASTRO = 'FPGL_DT_CADASTRO';
    const FPGL_DT_UPDATE = 'FPGL_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::PLUF_ID . '`, '
        . ' `' . self::FPGL_IN_TIPO . '`, '
        . ' `' . self::FPGL_VL_TRANSACAO . '`, '
        . ' `' . self::FPGL_TX_DESCRICAO . '` '
        . ') VALUES (?,?,?,?,?)';

        const INS_BONIFICADO = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USUA_ID_BONIFICADO . '`, '
        . ' `' . self::FPGL_IN_TIPO . '`, '
        . ' `' . self::FPGL_VL_TRANSACAO . '`, '
        . ' `' . self::FPGL_TX_DESCRICAO . '` '
        . ') VALUES (?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USUA_ID_BONIFICADO . '` = ?, '
    . ' `' . self::PLUF_ID . '` = ?, '
    . ' `' . self::FPGL_IN_TIPO . '` = ?, '
    . ' `' . self::FPGL_VL_TRANSACAO . '` = ?, '
    . ' `' . self::FPGL_TX_DESCRICAO . '` = ?, '
    . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FPGL_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(FPGL_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::FPGL_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USUA_ID_BONIFICADO . '`, ' 
        . ' `' . self::PLUF_ID . '`, ' 
        . ' `' . self::FPGL_IN_TIPO . '`, ' 
        . ' `' . self::FPGL_VL_TRANSACAO . '`, ' 
        . ' `' . self::FPGL_TX_DESCRICAO . '`, ' 
        . ' `' . self::FPGL_IN_STATUS . '`, ' 
        . ' `' . self::FPGL_DT_CADASTRO . '`, ' 
        . ' `' . self::FPGL_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_FUNDO_PARTICIPACAO_GLOBAL_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_USUA_ID_BONIFICADO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_BONIFICADO . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_PLUF_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLUF_ID . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_IN_TIPO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_IN_TIPO . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_VL_TRANSACAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_VL_TRANSACAO . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_TX_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_TX_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;
    const UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FPGL_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::FPGL_ID . '` = ? ' ;

}
?>
