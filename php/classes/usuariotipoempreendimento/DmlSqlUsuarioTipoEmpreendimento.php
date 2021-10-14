<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioTipoEmpreendimento - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioTipoEmpreendimentoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioTipoEmpreendimentoDTO, Array[]<UsuarioTipoEmpreendimentoDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 09:56:34
*
*/

class DmlSqlUsuarioTipoEmpreendimento extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_TIPO_EMPREENDIMENTO';

    // colunas da tabela
    const USTE_ID = 'USTE_ID';
    const USUA_ID = 'USUA_ID';
    const TIEM_ID = 'TIEM_ID';
    const USTE_IN_STATUS = 'USTE_IN_STATUS';
    const USTE_DT_CADASTRO = 'USTE_DT_CADASTRO';
    const USTE_DT_UPDATE = 'USTE_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::TIEM_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::TIEM_ID . '` = ? '
    . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USTE_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(USTE_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::USTE_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::TIEM_ID . '`, ' 
        . ' `' . self::USTE_IN_STATUS . '`, ' 
        . ' `' . self::USTE_DT_CADASTRO . '`, ' 
        . ' `' . self::USTE_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_TIPO_EMPREENDIMENTO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;
    const UPD_USUARIO_TIPO_EMPREENDIMENTO_TIEM_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::TIEM_ID . '` = ? ' . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;
    const UPD_USUARIO_TIPO_EMPREENDIMENTO_USTE_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USTE_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;
    const UPD_USUARIO_TIPO_EMPREENDIMENTO_USTE_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USTE_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;
    const UPD_USUARIO_TIPO_EMPREENDIMENTO_USTE_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USTE_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;
}
?>





