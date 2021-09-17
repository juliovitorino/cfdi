<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaQrCode - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaQrCodeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaQrCodeDTO, Array[]<CampanhaQrCodeDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2021 11:31:19
*
*/

class DmlSqlCampanhaQrCode extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_QRCODES';

    // colunas da tabela
    const CAQR_ID = 'CAQR_ID';
    const CAQR_ID_PARENT = 'CAQR_ID_PARENT';
    const CAMP_ID = 'CAMP_ID';
    const CAQR_TX_QRCODE = 'CAQR_TX_QRCODE';
    const CAQR_NU_ORDER = 'CAQR_NU_ORDER';
    const CAQR_TX_TICKET = 'CAQR_TX_TICKET';
    const USUA_ID_GERADOR = 'USUA_ID_GERADOR';
    const CAQR_IN_STATUS = 'CAQR_IN_STATUS';
    const CAQR_DT_CADASTRO = 'CAQR_DT_CADASTRO';
    const CAQR_DT_UPDATE = 'CAQR_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::CAQR_ID_PARENT . '`, '
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::CAQR_TX_QRCODE . '`, '
        . ' `' . self::CAQR_NU_ORDER . '`, '
        . ' `' . self::CAQR_TX_TICKET . '`, '
        . ' `' . self::USUA_ID_GERADOR . '`, '
        . ') VALUES (?,?,?,?,?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::CAQR_ID_PARENT . '` = ?, '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::CAQR_TX_QRCODE . '` = ?, '
    . ' `' . self::CAQR_NU_ORDER . '` = ?, '
    . ' `' . self::CAQR_TX_TICKET . '` = ?, '
    . ' `' . self::USUA_ID_GERADOR . '` = ?, '
    . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAQR_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CAQR_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CAQR_ID . '`, ' 
        . ' `' . self::CAQR_ID_PARENT . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::CAQR_TX_QRCODE . '`, ' 
        . ' `' . self::CAQR_NU_ORDER . '`, ' 
        . ' `' . self::CAQR_TX_TICKET . '`, ' 
        . ' `' . self::USUA_ID_GERADOR . '`, ' 
        . ' `' . self::CAQR_IN_STATUS . '`, ' 
        . ' `' . self::CAQR_DT_CADASTRO . '`, ' 
        . ' `' . self::CAQR_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_QRCODES_CAQR_ID_PARENT_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_ID_PARENT . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_TX_QRCODE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_TX_QRCODE . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_NU_ORDER_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_NU_ORDER . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_TX_TICKET_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_TX_TICKET . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_USUA_ID_GERADOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_GERADOR . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;
    const UPD_CAMPANHA_QRCODES_CAQR_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAQR_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CAQR_ID . '` = ? ' ;



}
?>





