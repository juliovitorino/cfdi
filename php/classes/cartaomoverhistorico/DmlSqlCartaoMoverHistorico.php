<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCartaoMoverHistorico - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCartaoMoverHistoricoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CartaoMoverHistoricoDTO, Array[]<CartaoMoverHistoricoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 24/07/2021 10:20:31
*
*/

class DmlSqlCartaoMoverHistorico extends DmlSql
{

    // Tabela
    const TABELA = 'CARTAO_MOVER_HISTORICO';

    // colunas da tabela
    const CAMH_ID = 'CAMH_ID';
    const CART_ID = 'CART_ID';
    const USUA_ID_DE = 'USUA_ID_DE';
    const USUA_ID_PARA = 'USUA_ID_PARA';
    const CAMH_IN_STATUS = 'CAMH_IN_STATUS';
    const CAMH_DT_CADASTRO = 'CAMH_DT_CADASTRO';
    const CAMH_DT_UPDATE = 'CAMH_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CART_ID . '`, '
        . ' `' . self::USUA_ID_DE . '`, '
        . ' `' . self::USUA_ID_PARA . '` '
        . ') VALUES (?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CART_ID . '` = ?, '
    . ' `' . self::USUA_ID_DE . '` = ?, '
    . ' `' . self::USUA_ID_PARA . '` = ? '
    . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAMH_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CAMH_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CAMH_ID . '`, ' 
        . ' `' . self::CART_ID . '`, ' 
        . ' `' . self::USUA_ID_DE . '`, ' 
        . ' `' . self::USUA_ID_PARA . '`, ' 
        . ' `' . self::CAMH_IN_STATUS . '`, ' 
        . ' `' . self::CAMH_DT_CADASTRO . '`, ' 
        . ' `' . self::CAMH_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CARTAO_MOVER_HISTORICO_CART_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CART_ID . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;
    const UPD_CARTAO_MOVER_HISTORICO_USUA_ID_DE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_DE . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;
    const UPD_CARTAO_MOVER_HISTORICO_USUA_ID_PARA_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID_PARA . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;
    const UPD_CARTAO_MOVER_HISTORICO_CAMH_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMH_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;
    const UPD_CARTAO_MOVER_HISTORICO_CAMH_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMH_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;
    const UPD_CARTAO_MOVER_HISTORICO_CAMH_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMH_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CAMH_ID . '` = ? ' ;

}
?>

