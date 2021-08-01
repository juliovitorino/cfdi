<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaCashbackResgatePix - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaCashbackResgatePixDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaCashbackResgatePixDTO, Array[]<CampanhaCashbackResgatePixDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/07/2021 15:11:48
*
*/

class DmlSqlCampanhaCashbackResgatePix extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_CASHBACK_RESGATE_PIX';

    // colunas da tabela
    const CCRP_ID = 'CCRP_ID';
    const USUA_ID_DEVEDOR = 'USUA_ID_DEVEDOR';
    const USUA_ID = 'USUA_ID';
    const CCRP_IN_TIPO_CHAVE_PIX = 'CCRP_IN_TIPO_CHAVE_PIX';
    const CCRP_TX_CHAVE_PIX = 'CCRP_TX_CHAVE_PIX';
    const CCRP_VL_RESGATE = 'CCRP_VL_RESGATE';
    const CCRP_TX_AUTENT_BCO = 'CCRP_TX_AUTENT_BCO';
    const CCRP_IN_ESTAGIO_RT = 'CCRP_IN_ESTAGIO_RT';
    const CCRP_DT_ESTAGIO_ANALISE = 'CCRP_DT_ESTAGIO_ANALISE';
    const CCRP_DT_ESTAGIO_FINANCEIRO = 'CCRP_DT_ESTAGIO_FINANCEIRO';
    const CCRP_DT_ESTAGIO_ERRO = 'CCRP_DT_ESTAGIO_ERRO';
    const CCRP_DT_ESTAGIO_TRANSF_BCO = 'CCRP_DT_ESTAGIO_TRANSF_BCO';
    const CCRP_TX_LIVRE_ESTAGIO_RT = 'CCRP_TX_LIVRE_ESTAGIO_RT';
    const CCRP_IN_STATUS = 'CCRP_IN_STATUS';
    const CCRP_DT_CADASTRO = 'CCRP_DT_CADASTRO';
    const CCRP_DT_UPDATE = 'CCRP_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID_DEVEDOR . '`, '
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::CCRP_IN_TIPO_CHAVE_PIX . '`, '
        . ' `' . self::CCRP_TX_CHAVE_PIX . '`, '
        . ' `' . self::CCRP_VL_RESGATE . '` '
        . ') VALUES (?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID_DEVEDOR . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::CCRP_IN_TIPO_CHAVE_PIX . '` = ?, '
    . ' `' . self::CCRP_TX_CHAVE_PIX . '` = ?, '
    . ' `' . self::CCRP_VL_RESGATE . '` = ?, '
    . ' `' . self::CCRP_TX_AUTENT_BCO . '` = ?, '
    . ' `' . self::CCRP_IN_ESTAGIO_RT . '` = ?, '
    . ' `' . self::CCRP_DT_ESTAGIO_ANALISE . '` = ?, '
    . ' `' . self::CCRP_DT_ESTAGIO_FINANCEIRO . '` = ?, '
    . ' `' . self::CCRP_DT_ESTAGIO_ERRO . '` = ?, '
    . ' `' . self::CCRP_DT_ESTAGIO_TRANSF_BCO . '` = ?, '
    . ' `' . self::CCRP_TX_LIVRE_ESTAGIO_RT . '` = ? '
    . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CCRP_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CCRP_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CCRP_ID . '`, ' 
        . ' `' . self::USUA_ID_DEVEDOR . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::CCRP_IN_TIPO_CHAVE_PIX . '`, ' 
        . ' `' . self::CCRP_TX_CHAVE_PIX . '`, ' 
        . ' `' . self::CCRP_VL_RESGATE . '`, ' 
        . ' `' . self::CCRP_TX_AUTENT_BCO . '`, ' 
        . ' `' . self::CCRP_IN_ESTAGIO_RT . '`, ' 
        . ' `' . self::CCRP_DT_ESTAGIO_ANALISE . '`, ' 
        . ' `' . self::CCRP_DT_ESTAGIO_FINANCEIRO . '`, ' 
        . ' `' . self::CCRP_DT_ESTAGIO_ERRO . '`, ' 
        . ' `' . self::CCRP_DT_ESTAGIO_TRANSF_BCO . '`, ' 
        . ' `' . self::CCRP_TX_LIVRE_ESTAGIO_RT . '`, ' 
        . ' `' . self::CCRP_IN_STATUS . '`, ' 
        . ' `' . self::CCRP_DT_CADASTRO . '`, ' 
        . ' `' . self::CCRP_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_USUA_ID_DEVEDOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_DEVEDOR . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_IN_TIPO_CHAVE_PIX_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_IN_TIPO_CHAVE_PIX . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_CHAVE_PIX_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_TX_CHAVE_PIX . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_VL_RESGATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_VL_RESGATE . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_AUTENT_BCO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_TX_AUTENT_BCO . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_IN_ESTAGIO_RT_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_IN_ESTAGIO_RT . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_ANALISE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_ESTAGIO_ANALISE . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_FINANCEIRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_ESTAGIO_FINANCEIRO . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_ERRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_ESTAGIO_ERRO . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_TRANSF_BCO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_ESTAGIO_TRANSF_BCO . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_LIVRE_ESTAGIO_RT_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_TX_LIVRE_ESTAGIO_RT . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CCRP_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CCRP_ID . '` = ? ' ;



}
?>





