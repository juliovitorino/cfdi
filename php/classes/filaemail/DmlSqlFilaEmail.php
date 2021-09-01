<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlFilaEmail - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLFilaEmailDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um FilaEmailDTO, Array[]<FilaEmailDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 01/09/2021 15:29:49
*
*/

class DmlSqlFilaEmail extends DmlSql
{

    // Tabela
    const TABELA = 'FILA_EMAIL';

    // colunas da tabela
    const FIEM_ID = 'FIEM_ID';
    const FIEM_NM_FILA = 'FIEM_NM_FILA';
    const FIEM_TX_EMAIL_DE = 'FIEM_TX_EMAIL_DE';
    const FIEM_TX_EMAIL_PARA = 'FIEM_TX_EMAIL_PARA';
    const FIEM_TX_ASSUNTO = 'FIEM_TX_ASSUNTO';
    const FIEM_IN_PRIOR = 'FIEM_IN_PRIOR';
    const FIEM_TX_TEMPLATE = 'FIEM_TX_TEMPLATE';
    const FIEM_NU_MAX_TENTATIVA = 'FIEM_NU_MAX_TENTATIVA';
    const FIEM_NU_TENTATIVA_REAL = 'FIEM_NU_TENTATIVA_REAL';
    const FIEM_DT_PREV_ENVIO = 'FIEM_DT_PREV_ENVIO';
    const FIEM_DT_REAL_ENVIO = 'FIEM_DT_REAL_ENVIO';
    const FIEM_IN_STATUS = 'FIEM_IN_STATUS';
    const FIEM_DT_CADASTRO = 'FIEM_DT_CADASTRO';
    const FIEM_DT_UPDATE = 'FIEM_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::FIEM_NM_FILA . '`, '
        . ' `' . self::FIEM_TX_EMAIL_DE . '`, '
        . ' `' . self::FIEM_TX_EMAIL_PARA . '`, '
        . ' `' . self::FIEM_TX_ASSUNTO . '`, '
        . ' `' . self::FIEM_IN_PRIOR . '`, '
        . ' `' . self::FIEM_TX_TEMPLATE . '`, '
        . ' `' . self::FIEM_NU_MAX_TENTATIVA . '`, '
        . ' `' . self::FIEM_DT_PREV_ENVIO . '` '
        . ') VALUES (?,?,?,?,?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FIEM_NM_FILA . '` = ?, '
    . ' `' . self::FIEM_TX_EMAIL_DE . '` = ?, '
    . ' `' . self::FIEM_TX_EMAIL_PARA . '` = ?, '
    . ' `' . self::FIEM_TX_ASSUNTO . '` = ?, '
    . ' `' . self::FIEM_IN_PRIOR . '` = ?, '
    . ' `' . self::FIEM_TX_TEMPLATE . '` = ?, '
    . ' `' . self::FIEM_NU_MAX_TENTATIVA . '` = ?, '
    . ' `' . self::FIEM_NU_TENTATIVA_REAL . '` = ?, '
    . ' `' . self::FIEM_DT_PREV_ENVIO . '` = ?, '
    . ' `' . self::FIEM_DT_REAL_ENVIO . '` = ? '
    . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FIEM_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(FIEM_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::FIEM_ID . '`, ' 
        . ' `' . self::FIEM_NM_FILA . '`, ' 
        . ' `' . self::FIEM_TX_EMAIL_DE . '`, ' 
        . ' `' . self::FIEM_TX_EMAIL_PARA . '`, ' 
        . ' `' . self::FIEM_TX_ASSUNTO . '`, ' 
        . ' `' . self::FIEM_IN_PRIOR . '`, ' 
        . ' `' . self::FIEM_TX_TEMPLATE . '`, ' 
        . ' `' . self::FIEM_NU_MAX_TENTATIVA . '`, ' 
        . ' `' . self::FIEM_NU_TENTATIVA_REAL . '`, ' 
        . ' `' . self::FIEM_DT_PREV_ENVIO . '`, ' 
        . ' `' . self::FIEM_DT_REAL_ENVIO . '`, ' 
        . ' `' . self::FIEM_IN_STATUS . '`, ' 
        . ' `' . self::FIEM_DT_CADASTRO . '`, ' 
        . ' `' . self::FIEM_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_FILA_EMAIL_FIEM_NM_FILA_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_NM_FILA . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_TX_EMAIL_DE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_TX_EMAIL_DE . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_TX_EMAIL_PARA_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_TX_EMAIL_PARA . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_TX_ASSUNTO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_TX_ASSUNTO . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_IN_PRIOR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_IN_PRIOR . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_TX_TEMPLATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_TX_TEMPLATE . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_NU_MAX_TENTATIVA_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_NU_MAX_TENTATIVA . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_NU_TENTATIVA_REAL_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_NU_TENTATIVA_REAL . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_DT_PREV_ENVIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_DT_PREV_ENVIO . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_DT_REAL_ENVIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_DT_REAL_ENVIO . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;
    const UPD_FILA_EMAIL_FIEM_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FIEM_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::FIEM_ID . '` = ? ' ;

}
?>





