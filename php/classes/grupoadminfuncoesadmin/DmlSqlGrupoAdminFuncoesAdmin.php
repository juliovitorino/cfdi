<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlGrupoAdminFuncoesAdmin - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLGrupoAdminFuncoesAdminDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um GrupoAdminFuncoesAdminDTO, Array[]<GrupoAdminFuncoesAdminDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 18:54:21
*
*/

class DmlSqlGrupoAdminFuncoesAdmin extends DmlSql
{

    // Tabela
    const TABELA = 'SEGLOG_GRUPO_ADM_FUNCAO_ADM';

    // colunas da tabela
    const GAFA_ID = 'GAFA_ID';
    const GRAD_ID = 'GRAD_ID';
    const FUAD_ID = 'FUAD_ID';
    const GAFA_IN_CRUD_CRIAR = 'GAFA_IN_CRUD_CRIAR';
    const GAFA_IN_CRUD_RECUPERAR = 'GAFA_IN_CRUD_RECUPERAR';
    const GAFA_IN_CRUD_ATUALIZAR = 'GAFA_IN_CRUD_ATUALIZAR';
    const GAFA_IN_CRUD_EXCLUIR = 'GAFA_IN_CRUD_EXCLUIR';
    const GAFA_IN_STATUS = 'GAFA_IN_STATUS';
    const GAFA_DT_CADASTRO = 'GAFA_DT_CADASTRO';
    const GAFA_DT_UPDATE = 'GAFA_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::GRAD_ID . '`, '
        . ' `' . self::FUAD_ID . '` '
        . ') VALUES (?,?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GRAD_ID . '` = ?, '
    . ' `' . self::FUAD_ID . '` = ?, '
    . ' `' . self::GAFA_IN_CRUD_CRIAR . '` = ?, '
    . ' `' . self::GAFA_IN_CRUD_RECUPERAR . '` = ?, '
    . ' `' . self::GAFA_IN_CRUD_ATUALIZAR . '` = ?, '
    . ' `' . self::GAFA_IN_CRUD_EXCLUIR . '` = ? '
    . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GAFA_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(GAFA_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::GAFA_ID . '`, ' 
        . ' `' . self::GRAD_ID . '`, ' 
        . ' `' . self::FUAD_ID . '`, ' 
        . ' `' . self::GAFA_IN_CRUD_CRIAR . '`, ' 
        . ' `' . self::GAFA_IN_CRUD_RECUPERAR . '`, ' 
        . ' `' . self::GAFA_IN_CRUD_ATUALIZAR . '`, ' 
        . ' `' . self::GAFA_IN_CRUD_EXCLUIR . '`, ' 
        . ' `' . self::GAFA_IN_STATUS . '`, ' 
        . ' `' . self::GAFA_DT_CADASTRO . '`, ' 
        . ' `' . self::GAFA_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GRAD_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GRAD_ID . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_FUAD_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::FUAD_ID . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_CRIAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_IN_CRUD_CRIAR . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_RECUPERAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_IN_CRUD_RECUPERAR . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_ATUALIZAR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_IN_CRUD_ATUALIZAR . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_EXCLUIR_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_IN_CRUD_EXCLUIR . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::GAFA_ID . '` = ? ' ;

}
?>





