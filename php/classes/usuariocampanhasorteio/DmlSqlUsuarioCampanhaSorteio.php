<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioCampanhaSorteio - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioCampanhaSorteioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioCampanhaSorteioDTO, Array[]<UsuarioCampanhaSorteioDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 08:05:45
*
*/

class DmlSqlUsuarioCampanhaSorteio extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_CAMPANHA_SORTEIO';

    // colunas da tabela
    const USCS_ID = 'USCS_ID';
    const USUA_ID = 'USUA_ID';
    const CASO_ID = 'CASO_ID';
    const USCS_IN_STATUS = 'USCS_IN_STATUS';
    const USCS_DT_CADASTRO = 'USCS_DT_CADASTRO';
    const USCS_DT_UPDATE = 'USCS_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::USUA_ID . '`, '
        . ' `' . self::CASO_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::CASO_ID . '` = ?, '
    . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USCS_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;

const SELECT_MAX_PK = 'SELECT MAX(USCS_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::USCS_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::CASO_ID . '`, ' 
        . ' `' . self::USCS_IN_STATUS . '`, ' 
        . ' `' . self::USCS_DT_CADASTRO . '`, ' 
        . ' `' . self::USCS_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_CAMPANHA_SORTEIO_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_CASO_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_ID . '` = ? ' . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_USCS_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCS_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_USCS_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCS_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_USCS_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCS_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::USCS_ID . '` = ? ' ;
}
?>

