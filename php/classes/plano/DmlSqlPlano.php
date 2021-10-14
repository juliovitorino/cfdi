<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlPlano - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLPlanoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um PlanoDTO, Array[]<PlanoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 08/09/2021 14:15:34
*
*/

class DmlSqlPlano extends DmlSql
{

    // Tabela
    const TABELA = 'PLANOS';

    // colunas da tabela
    const PLAN_ID = 'PLAN_ID';
    const PLAN_NM_PLANO = 'PLAN_NM_PLANO';
    const PLAN_TX_PERMISSAO = 'PLAN_TX_PERMISSAO';
    const PLAN_VL_PLANO = 'PLAN_VL_PLANO';
    const PLAN_IN_TIPO = 'PLAN_IN_TIPO';
    const PLAN_IN_STATUS = 'PLAN_IN_STATUS';
    const PLAN_DT_CADASTRO = 'PLAN_DT_CADASTRO';
    const PLAN_DT_UPDATE = 'PLAN_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::PLAN_NM_PLANO . '`, '
        . ' `' . self::PLAN_TX_PERMISSAO . '`, '
        . ' `' . self::PLAN_VL_PLANO . '`, '
        . ' `' . self::PLAN_IN_TIPO . '` '
        . ') VALUES (?,?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::PLAN_NM_PLANO . '` = ?, '
    . ' `' . self::PLAN_TX_PERMISSAO . '` = ?, '
    . ' `' . self::PLAN_VL_PLANO . '` = ?, '
    . ' `' . self::PLAN_IN_TIPO . '` = ? '
    . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::PLAN_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(PLAN_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::PLAN_ID . '`, ' 
        . ' `' . self::PLAN_NM_PLANO . '`, ' 
        . ' `' . self::PLAN_TX_PERMISSAO . '`, ' 
        . ' `' . self::PLAN_VL_PLANO . '`, ' 
        . ' `' . self::PLAN_IN_TIPO . '`, ' 
        . ' `' . self::PLAN_IN_STATUS . '`, ' 
        . ' `' . self::PLAN_DT_CADASTRO . '`, ' 
        . ' `' . self::PLAN_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_PLANOS_PLAN_NM_PLANO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_NM_PLANO . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_TX_PERMISSAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_TX_PERMISSAO . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_VL_PLANO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_VL_PLANO . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_IN_TIPO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_IN_TIPO . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;
    const UPD_PLANOS_PLAN_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::PLAN_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::PLAN_ID . '` = ? ' ;

    // ADAPTACAO DA VERSAO ANTIGA
    const WHERE_PK = self::SELECT . ' WHERE `' . self::PLAN_ID . '` = ?';
	const WHERE_STATUS = self::SELECT . ' WHERE `PLAN_IN_STATUS` = ?';



}
?>





