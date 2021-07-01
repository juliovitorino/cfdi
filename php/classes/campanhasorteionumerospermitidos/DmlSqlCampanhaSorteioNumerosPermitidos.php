<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaSorteioNumerosPermitidos - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaSorteioNumerosPermitidosDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaSorteioNumerosPermitidosDTO, Array[]<CampanhaSorteioNumerosPermitidosDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 17:44:16
*
*/

class DmlSqlCampanhaSorteioNumerosPermitidos extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS';

    // colunas da tabela
    const CSNP_ID = 'CSNP_ID';
    const CASO_ID = 'CASO_ID';
    const CSNP_NU_SORTEIO = 'CSNP_NU_SORTEIO';
    const CSNP_IN_STATUS = 'CSNP_IN_STATUS';
    const CSNP_DT_CADASTRO = 'CSNP_DT_CADASTRO';
    const CSNP_DT_UPDATE = 'CSNP_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CASO_ID . '`, '
        . ' `' . self::CSNP_NU_SORTEIO . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::CASO_ID . '` = ?, '
    . ' `' . self::CSNP_NU_SORTEIO . '` = ?, '
    . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CSNP_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CSNP_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::CSNP_ID . '`, ' 
        . ' `' . self::CASO_ID . '`, ' 
        . ' `' . self::CSNP_NU_SORTEIO . '`, ' 
        . ' `' . self::CSNP_IN_STATUS . '`, ' 
        . ' `' . self::CSNP_DT_CADASTRO . '`, ' 
        . ' `' . self::CSNP_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CASO_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_ID . '` = ? ' . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CSNP_NU_SORTEIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSNP_NU_SORTEIO . '` = ? ' . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CSNP_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSNP_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CSNP_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSNP_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;
    const UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CSNP_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CSNP_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CSNP_ID . '` = ? ' ;

}
?>
