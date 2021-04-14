<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlFilaQRCodePendenteProduzir - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLFilaQRCodePendenteProduzirDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um FilaQRCodePendenteProduzirDTO, Array[]<FilaQRCodePendenteProduzirDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/10/2019 10:27:47
*
*/

class DmlSqlFilaQRCodePendenteProduzir extends DmlSql
{

    // Tabela
    const TABELA = 'FILA_QRCODES_PNDNT_PRD';

    // colunas da tabela
    const FQPP_ID = 'FQPP_ID';
    const CAMP_ID = 'CAMP_ID';
    const USUA_ID = 'USUA_ID';
    const FQPP_NU_QTDE_QRC = 'FQPP_NU_QTDE_QRC';
    const FQPP_IN_STATUS = 'FQPP_IN_STATUS';
    const FQPP_DT_CADASTRO = 'FQPP_DT_CADASTRO';
    const FQPP_DT_UPDATE = 'FQPP_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::FQPP_NU_QTDE_QRC . '` '
        . ') VALUES (?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::FQPP_NU_QTDE_QRC . '` = ? '
    . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FQPP_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(FQPP_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::FQPP_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::FQPP_NU_QTDE_QRC . '`, ' 
        . ' `' . self::FQPP_IN_STATUS . '`, ' 
        . ' `' . self::FQPP_DT_CADASTRO . '`, ' 
        . ' `' . self::FQPP_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_FILA_QRCODES_PNDNT_PRD_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
    const UPD_FILA_QRCODES_PNDNT_PRD_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
    const UPD_FILA_QRCODES_PNDNT_PRD_FQPP_NU_QTDE_QRC_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FQPP_NU_QTDE_QRC . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
    const UPD_FILA_QRCODES_PNDNT_PRD_FQPP_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FQPP_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
    const UPD_FILA_QRCODES_PNDNT_PRD_FQPP_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FQPP_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
    const UPD_FILA_QRCODES_PNDNT_PRD_FQPP_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FQPP_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::FQPP_ID . '` = ? ' ;
}
?>





