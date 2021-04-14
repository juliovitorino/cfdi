<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* DmlSqlCampanhaCashbackCC - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaCashbackCCDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaCashbackCCDTO, Array[]<CampanhaCashbackCCDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

class DmlSqlCampanhaCashbackCC extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_CASHBACK_CC';

    // colunas da tabela
    const CACC_ID = 'CACC_ID';
    const CACA_ID = 'CACA_ID';
    const CAMP_ID = 'CAMP_ID';
    const USUA_ID = 'USUA_ID';
    const USUA_ID_DONO = 'USUA_ID_DONO';
    const CFDI_ID = 'CFDI_ID';
    const CACC_TX_DESCRICAO = 'CACC_TX_DESCRICAO';
    const CACC_VL_MIN = 'CACC_VL_MIN';
    const CACC_VL_PERC_CASHBACK = 'CACC_VL_PERC_CASHBACK';
    const CACC_VL_CONSUMO = 'CACC_VL_CONSUMO';
    const CACC_VL_RECOMPENSA = 'CACC_VL_RECOMPENSA';
    const CACC_IN_TIPO = 'CACC_IN_TIPO';
    const CACC_TX_NFE = 'CACC_TX_NFE';
    const CACC_TX_NFE_HASH = 'CACC_TX_NFE_HASH';
    const CACC_IN_STATUS = 'CACC_IN_STATUS';
    const CACC_DT_CADASTRO = 'CACC_DT_CADASTRO';
    const CACC_DT_UPDATE = 'CACC_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CACA_ID . '`, '
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USUA_ID_DONO . '`, '
        . ' `' . self::CFDI_ID . '`, '
        . ' `' . self::CACC_TX_DESCRICAO . '`, '
        //. ' `' . self::CACC_VL_MIN . '`, '
        . ' `' . self::CACC_VL_PERC_CASHBACK . '`, '
        . ' `' . self::CACC_VL_CONSUMO . '`, '
        . ' `' . self::CACC_VL_RECOMPENSA . '`, '
        . ' `' . self::CACC_IN_TIPO . '`, '
        . ' `' . self::CACC_TX_NFE . '`, '
        . ' `' . self::CACC_TX_NFE_HASH . '` '
//        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';

    const INS_MOVCC = 'INSERT INTO `' . self::TABELA . '` ('
    . ' `' . self::USUA_ID . '`, '
    . ' `' . self::USUA_ID_DONO . '`, '
    . ' `' . self::CACC_TX_DESCRICAO . '`, '
    . ' `' . self::CACC_VL_CONSUMO . '`, '
    . ' `' . self::CACC_VL_RECOMPENSA . '`, '
    . ' `' . self::CACC_IN_TIPO . '` '
    . ') VALUES (?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CACA_ID . '` = ?, '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USUA_ID_DONO . '` = ?, '
    . ' `' . self::CFDI_ID . '` = ?, '
    . ' `' . self::CACC_TX_DESCRICAO . '` = ?, '
    //. ' `' . self::CACC_VL_MIN . '` = ?, '
    . ' `' . self::CACC_VL_PERC_CASHBACK . '` = ?, '
    . ' `' . self::CACC_VL_CONSUMO . '` = ?, '
    . ' `' . self::CACC_VL_RECOMPENSA . '` = ?, '
    . ' `' . self::CACC_IN_TIPO . '` = ?, '
    . ' `' . self::CACC_TX_NFE . '` = ?, '
    . ' `' . self::CACC_TX_NFE_HASH . '` = ? '
    . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CACC_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::CACC_ID . '`, ' 
        . ' `' . self::CACA_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USUA_ID_DONO . '`, ' 
        . ' `' . self::CFDI_ID . '`, ' 
        . ' `' . self::CACC_TX_DESCRICAO . '`, ' 
        //. ' `' . self::CACC_VL_MIN . '`, ' 
        . ' `' . self::CACC_VL_PERC_CASHBACK . '`, ' 
        . ' `' . self::CACC_VL_CONSUMO . '`, ' 
        . ' `' . self::CACC_VL_RECOMPENSA . '`, ' 
        . ' `' . self::CACC_IN_TIPO . '`, ' 
        . ' `' . self::CACC_TX_NFE . '`, ' 
        . ' `' . self::CACC_TX_NFE_HASH . '`, ' 
        . ' `' . self::CACC_IN_STATUS . '`, ' 
        . ' `' . self::CACC_DT_CADASTRO . '`, ' 
        . ' `' . self::CACC_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const SQL_MAX = 'SELECT MAX(' . self::CACC_ID . ') AS maxid '
    . ' FROM `'.self::TABELA.'` ';
    
    const UPD_CAMPANHA_CASHBACK_CC_CACA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CFDI_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CFDI_ID . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_TX_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_TX_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    //const UPD_CAMPANHA_CASHBACK_CC_CACC_VL_MIN_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_VL_MIN . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_VL_PERC_CASHBACK_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_VL_PERC_CASHBACK . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_VL_CONSUMO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_VL_CONSUMO . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_VL_RECOMPENSA_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_VL_RECOMPENSA . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_IN_TIPO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_IN_TIPO . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_TX_NFE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_TX_NFE . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_TX_NFE_HASH_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_TX_NFE_HASH . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;
    const UPD_CAMPANHA_CASHBACK_CC_CACC_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CACC_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CACC_ID . '` = ? ' ;



}
?>





