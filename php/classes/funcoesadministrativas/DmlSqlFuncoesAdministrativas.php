<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlFuncoesAdministrativas - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLFuncoesAdministrativasDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um FuncoesAdministrativasDTO, Array[]<FuncoesAdministrativasDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 15:09:15
*
*/

class DmlSqlFuncoesAdministrativas extends DmlSql
{

    // Tabela
    const TABELA = 'SEGLOG_FUNCOES_ADMINISTRATIVAS';

    // colunas da tabela
    const FUAD_ID = 'FUAD_ID';
    const FUAD_NM_DESCRICAO = 'FUAD_NM_DESCRICAO';
    const FUAD_IN_STATUS = 'FUAD_IN_STATUS';
    const FUAD_DT_CADASTRO = 'FUAD_DT_CADASTRO';
    const FUAD_DT_UPDATE = 'FUAD_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::FUAD_NM_DESCRICAO . '` '
        . ') VALUES (?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::FUAD_NM_DESCRICAO . '` = ? '
    . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::FUAD_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(FUAD_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::FUAD_ID . '`, ' 
        . ' `' . self::FUAD_NM_DESCRICAO . '`, ' 
        . ' `' . self::FUAD_IN_STATUS . '`, ' 
        . ' `' . self::FUAD_DT_CADASTRO . '`, ' 
        . ' `' . self::FUAD_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_SEGLOG_FUNCOES_ADMINISTRATIVAS_FUAD_NM_DESCRICAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FUAD_NM_DESCRICAO . '` = ? ' . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;
    const UPD_SEGLOG_FUNCOES_ADMINISTRATIVAS_FUAD_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FUAD_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;
    const UPD_SEGLOG_FUNCOES_ADMINISTRATIVAS_FUAD_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FUAD_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;
    const UPD_SEGLOG_FUNCOES_ADMINISTRATIVAS_FUAD_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FUAD_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::FUAD_ID . '` = ? ' ;

}
?>
