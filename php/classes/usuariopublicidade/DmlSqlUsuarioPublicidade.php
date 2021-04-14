<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioPublicidade - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioPublicidadeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioPublicidadeDTO, Array[]<UsuarioPublicidadeDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/09/2019 13:57:12
*
*/

class DmlSqlUsuarioPublicidade extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_PUBLICIDADE';

    // colunas da tabela
    const USPU_ID = 'USPU_ID';
    const USUA_ID = 'USUA_ID';
    const USPU_TX_TITULO = 'USPU_TX_TITULO';
    const USPU_TX_DESCRICAO = 'USPU_TX_DESCRICAO';
    const USPU_DT_INICIO = 'USPU_DT_INICIO';
    const USPU_DT_TERMINO = 'USPU_DT_TERMINO';
    const USPU_VL_NORMAL = 'USPU_VL_NORMAL';
    const USPU_VL_PROMO = 'USPU_VL_PROMO';
    const USPU_TX_OBS = 'USPU_TX_OBS';
    const USPU_DT_APAGAR = 'USPU_DT_APAGAR';
    const USPU_IN_MODELO = 'USPU_IN_MODELO';
    const USPU_IN_STATUS = 'USPU_IN_STATUS';
    const USPU_DT_CADASTRO = 'USPU_DT_CADASTRO';
    const USPU_DT_UPDATE = 'USPU_DT_UPDATE';
    const USPU_TX_URL = 'USPU_TX_URL';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::USPU_TX_TITULO . '`, '
        . ' `' . self::USPU_TX_DESCRICAO . '`, '
        . ' `' . self::USPU_DT_INICIO . '`, '
        . ' `' . self::USPU_DT_TERMINO . '`, '
        . ' `' . self::USPU_VL_NORMAL . '`, '
        . ' `' . self::USPU_VL_PROMO . '`, '
        . ' `' . self::USPU_TX_OBS . '` '
        . ') VALUES (?,?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::USPU_TX_TITULO . '` = ?, '
    . ' `' . self::USPU_TX_DESCRICAO . '` = ?, '
    . ' `' . self::USPU_DT_INICIO . '` = ?, '
    . ' `' . self::USPU_DT_TERMINO . '` = ?, '
    . ' `' . self::USPU_VL_NORMAL . '` = ?, '
    . ' `' . self::USPU_VL_PROMO . '` = ?, '
    . ' `' . self::USPU_TX_OBS . '` = ? '
    . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USPU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USPU_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::USPU_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::USPU_TX_TITULO . '`, ' 
        . ' `' . self::USPU_TX_DESCRICAO . '`, ' 
        . ' `' . self::USPU_DT_INICIO . '`, ' 
        . ' `' . self::USPU_DT_TERMINO . '`, ' 
        . ' `' . self::USPU_VL_NORMAL . '`, ' 
        . ' `' . self::USPU_VL_PROMO . '`, ' 
        . ' `' . self::USPU_TX_OBS . '`, ' 
        . ' `' . self::USPU_DT_APAGAR . '`, ' 
        . ' `' . self::USPU_TX_URL . '`, ' 
        . ' `' . self::USPU_IN_STATUS . '`, ' 
        . ' `' . self::USPU_IN_MODELO . '`, ' 
        . ' `' . self::USPU_DT_CADASTRO . '`, ' 
        . ' `' . self::USPU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';
        

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_PUBLICIDADE_USPU_IN_MODELO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_IN_MODELO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_TX_URL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_TX_URL . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_TX_TITULO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_TX_TITULO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_TX_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_TX_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_DT_INICIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_DT_INICIO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_DT_TERMINO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_DT_TERMINO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_VL_NORMAL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_VL_NORMAL . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_VL_PROMO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_VL_PROMO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_TX_OBS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_TX_OBS . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_DT_APAGAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_DT_APAGAR . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;
    const UPD_USUARIO_PUBLICIDADE_USPU_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USPU_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USPU_ID . '` = ? ' ;

}
?>
