<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
*
* DmlSqlCampanhaSorteio - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaSorteioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaSorteioDTO, Array[]<CampanhaSorteioDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 16/06/2021 12:57:19
*
*/

class DmlSqlCampanhaSorteio extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_SORTEIO';

    // colunas da tabela
    const CASO_ID = 'CASO_ID';
    const CAMP_ID = 'CAMP_ID';
    const CASO_TX_NOME = 'CASO_TX_NOME';
    const CASO_TX_URL_REGULAMENTO = 'CASO_TX_URL_REGULAMENTO';
    const CASO_TX_PREMIO = 'CASO_TX_PREMIO';
    const CASO_DT_INICIO = 'CASO_DT_INICIO';
    const CASO_DT_TERMINO = 'CASO_DT_TERMINO';
    const CASO_NU_MAX_TICKET = 'CASO_NU_MAX_TICKET';
    const CASO_IN_STATUS = 'CASO_IN_STATUS';
    const CASO_DT_CADASTRO = 'CASO_DT_CADASTRO';
    const CASO_DT_UPDATE = 'CASO_DT_UPDATE';

     // Comandos DML
     const INS = 'INSERT INTO `' . self::TABELA . '` ('
          . ' `' . self::CAMP_ID . '`, '
          . ' `' . self::CASO_TX_NOME . '`, '
          . ' `' . self::CASO_TX_URL_REGULAMENTO . '`, '
          . ' `' . self::CASO_TX_PREMIO . '`, '
          . ' `' . self::CASO_NU_MAX_TICKET . '` '
          . ') VALUES (?,?,?,?,?)';

     const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
     'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;

     const UPD_PK = 'UPDATE `' . self::TABELA . '` set '

     . ' `' . self::CAMP_ID . '` = ?, '
     . ' `' . self::CASO_TX_NOME . '` = ?, '
     . ' `' . self::CASO_TX_URL_REGULAMENTO . '` = ?, '
     . ' `' . self::CASO_TX_PREMIO . '` = ?, '
     . ' `' . self::CASO_DT_INICIO . '` = ?, '
     . ' `' . self::CASO_DT_TERMINO . '` = ?, '
     . ' `' . self::CASO_NU_MAX_TICKET . '` = ?, '
     . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;

     const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
     . ' `' . self::CASO_IN_STATUS . '` = ? '
     . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CASO_ID) AS maxid FROM `'.self::TABELA.'` ';


     const SELECT = 'SELECT ' 
          . ' `' . self::CASO_ID . '`, ' 
          . ' `' . self::CAMP_ID . '`, ' 
          . ' `' . self::CASO_TX_NOME . '`, ' 
          . ' `' . self::CASO_TX_URL_REGULAMENTO . '`, ' 
          . ' `' . self::CASO_TX_PREMIO . '`, ' 
          . ' `' . self::CASO_DT_INICIO . '`, ' 
          . ' `' . self::CASO_DT_TERMINO . '`, ' 
          . ' `' . self::CASO_NU_MAX_TICKET . '`, ' 
          . ' `' . self::CASO_IN_STATUS . '`, ' 
          . ' `' . self::CASO_DT_CADASTRO . '`, ' 
          . ' `' . self::CASO_DT_UPDATE . '` ' 
          . ' FROM `'.self::TABELA.'` ';

     const SQL_COUNT = 'SELECT COUNT(*) AS contador '
     . ' FROM `'.self::TABELA.'` ';

     const UPD_CAMPANHA_SORTEIO_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ';
     const UPD_CAMPANHA_SORTEIO_CASO_TX_NOME_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_TX_NOME . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_TX_URL_REGULAMENTO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_TX_URL_REGULAMENTO . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_TX_PREMIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_TX_PREMIO . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_DT_INICIO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_DT_INICIO . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_DT_TERMINO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_DT_TERMINO . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_NU_MAX_TICKET_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_NU_MAX_TICKET . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;
     const UPD_CAMPANHA_SORTEIO_CASO_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CASO_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CASO_ID . '` = ? ' ;



}
?>
