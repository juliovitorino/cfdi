<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlGrupoAdminFuncoesAdminUsuario - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLGrupoAdminFuncoesAdminUsuarioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um GrupoAdminFuncoesAdminUsuarioDTO, Array[]<GrupoAdminFuncoesAdminUsuarioDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 19:25:25
*
*/

class DmlSqlGrupoAdminFuncoesAdminUsuario extends DmlSql
{

    // Tabela
    const TABELA = 'SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO';

    // colunas da tabela
    const GAFAU_ID = 'GAFAU_ID';
    const GAFA_ID = 'GAFA_ID';
    const USUA_ID = 'USUA_ID';
    const GAFAU_IN_STATUS = 'GAFAU_IN_STATUS';
    const GAFAU_DT_CADASTRO = 'GAFAU_DT_CADASTRO';
    const GAFAU_DT_UPDATE = 'GAFAU_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::GAFA_ID . '`, '
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GAFA_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ? '
    . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::GAFAU_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(GAFAU_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::GAFAU_ID . '`, ' 
        . ' `' . self::GAFA_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::GAFAU_IN_STATUS . '`, ' 
        . ' `' . self::GAFAU_DT_CADASTRO . '`, ' 
        . ' `' . self::GAFAU_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_GAFA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFA_ID . '` = ? ' . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_GAFAU_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFAU_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_GAFAU_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFAU_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;
    const UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_GAFAU_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::GAFAU_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::GAFAU_ID . '` = ? ' ;

}
?>





