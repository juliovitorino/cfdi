<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlUsuarioCampanhaSorteioTicket - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLUsuarioCampanhaSorteioTicketDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um UsuarioCampanhaSorteioTicketDTO, Array[]<UsuarioCampanhaSorteioTicketDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 10:37:39
*
*/

class DmlSqlUsuarioCampanhaSorteioTicket extends DmlSql
{

    // Tabela
    const TABELA = 'USUARIO_CAMPANHA_SORTEIO_TICKETS';

    // colunas da tabela
    const UCST_ID = 'UCST_ID';
    const USCS_ID = 'USCS_ID';
    const UCST_NU_TICKET = 'UCST_NU_TICKET';
    const UCST_IN_STATUS = 'UCST_IN_STATUS';
    const UCST_DT_CADASTRO = 'UCST_DT_CADASTRO';
    const UCST_DT_UPDATE = 'UCST_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('

        . ' `' . self::USCS_ID . '`, '
        . ' `' . self::UCST_NU_TICKET . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

    . ' `' . self::USCS_ID . '` = ?, '
    . ' `' . self::UCST_NU_TICKET . '` = ?, '
    . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::UCST_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;

const SELECT_MAX_PK = 'SELECT MAX(UCST_ID) AS maxid FROM `'.self::TABELA.'` ';


    const SELECT = 'SELECT ' 
        . ' `' . self::UCST_ID . '`, ' 
        . ' `' . self::USCS_ID . '`, ' 
        . ' `' . self::UCST_NU_TICKET . '`, ' 
        . ' `' . self::UCST_IN_STATUS . '`, ' 
        . ' `' . self::UCST_DT_CADASTRO . '`, ' 
        . ' `' . self::UCST_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_USCS_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USCS_ID . '` = ? ' . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_UCST_NU_TICKET_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::UCST_NU_TICKET . '` = ? ' . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_UCST_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::UCST_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_UCST_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::UCST_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;
    const UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_UCST_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::UCST_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::UCST_ID . '` = ? ' ;

}
?>
