<?php

// importar dependências
require_once '../daofactory/DmlSql.php';
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* DmlSqlCampanhaTopDez - Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySQLCampanhaTopDezDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber os dados de pesquisa ou CRUD
* 2) Processar o pedido no banco de dados
* 3) Retornar um CampanhaTopDezDTO, Array[]<CampanhaTopDezDTO> ou falha em modo booleano
*
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 19/09/2019 08:36:54
*
*/

class DmlSqlCampanhaTopDez extends DmlSql
{

    // Tabela
    const TABELA = 'CAMPANHA_TOPDEZ';

    // colunas da tabela
    const CATO_ID = 'CATO_ID';
    const CAMP_ID = 'CAMP_ID';
    const USUA_ID = 'USUA_ID';
    const CATO_QT_PARTICIPACAO = 'CATO_QT_PARTICIPACAO';
    const CATO_IN_STATUS = 'CATO_IN_STATUS';
    const CATO_DT_CADASTRO = 'CATO_DT_CADASTRO';
    const CATO_DT_UPDATE = 'CATO_DT_UPDATE';

    // Comandos DML
    const INS = 'INSERT INTO `' . self::TABELA . '` ('
        . ' `' . self::CAMP_ID . '`, '
        . ' `' . self::USUA_ID . '` '
        . ') VALUES (?,?)';

    const DEL_PK = 'DELETE from `' . self::TABELA . '` ' .
    'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;

    const UPD_PK = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CAMP_ID . '` = ?, '
    . ' `' . self::USUA_ID . '` = ?, '
    . ' `' . self::CATO_QT_PARTICIPACAO . '` = ? '
    . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CATO_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;

    const UPD_INC_CATO_QT_PARTICIPACAO = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::CATO_QT_PARTICIPACAO  
    . '` = `' . self::CATO_QT_PARTICIPACAO . '` + 1 '
    . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;

    const SELECT_MAX_PK = 'SELECT MAX(CATO_ID) AS maxid FROM `'.self::TABELA.'` ';

    const SELECT = 'SELECT ' 
        . ' `' . self::CATO_ID . '`, ' 
        . ' `' . self::CAMP_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::CATO_QT_PARTICIPACAO . '`, ' 
        . ' `' . self::CATO_IN_STATUS . '`, ' 
        . ' `' . self::CATO_DT_CADASTRO . '`, ' 
        . ' `' . self::CATO_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';

    const SQL_COUNT = 'SELECT COUNT(*) AS contador '
    . ' FROM `'.self::TABELA.'` ';

    const UPD_CAMPANHA_TOPDEZ_CAMP_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CAMP_ID . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;
    const UPD_CAMPANHA_TOPDEZ_USUA_ID_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::USUA_ID . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;
    const UPD_CAMPANHA_TOPDEZ_CATO_QT_PARTICIPACAO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CATO_QT_PARTICIPACAO . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;
    const UPD_CAMPANHA_TOPDEZ_CATO_IN_STATUS_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CATO_IN_STATUS . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;
    const UPD_CAMPANHA_TOPDEZ_CATO_DT_CADASTRO_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CATO_DT_CADASTRO . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;
    const UPD_CAMPANHA_TOPDEZ_CATO_DT_UPDATE_PK = 'UPDATE `' . self::TABELA . '` set ' . ' `' . self::CATO_DT_UPDATE . '` = ? ' . 'WHERE ' . ' `' . self::CATO_ID . '` = ? ' ;

}
?>
