<?php

// importar dependências
require_once '../daofactory/DmlSql.php';

/**
* DmlSqlUsuarioTipoEmpreendimento - DML para tabela
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
    . ' `' . self::TIEM_ID . '` = ?, '
    . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;

    const UPD_STATUS = 'UPDATE `' . self::TABELA . '` set '
    . ' `' . self::USTE_IN_STATUS . '` = ? '
    . 'WHERE ' . ' `' . self::USTE_ID . '` = ? ' ;

    const SELECT = 'SELECT ' 
        . ' `' . self::USTE_ID . '`, ' 
        . ' `' . self::USUA_ID . '`, ' 
        . ' `' . self::TIEM_ID . '`, ' 
        . ' `' . self::USTE_IN_STATUS . '`, ' 
        . ' `' . self::USTE_DT_CADASTRO . '`, ' 
        . ' `' . self::USTE_DT_UPDATE . '` ' 
        . ' FROM `'.self::TABELA.'` ';
}
?>





