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
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
 * DmlSqlEstatisticaFuncao - DML para tabela
 */

class DmlSqlEstatisticaFuncao extends DmlSql
{

	// Tabela
	const TABELA = 'ESTATISTICA_FUNCAO';

	// colunas da tabela
	const ESFU_ID = 'ESFU_ID';
	const ESFU_NU_ANO = 'ESFU_NU_ANO';
	const ESFU_NU_MES = 'ESFU_NU_MES';
	const ESFU_NU_DIA = 'ESFU_NU_DIA';
	const ESFU_IN_TIPO = 'ESFU_IN_TIPO';
	const USUA_ID = 'USUA_ID';
	const PROJ_ID = 'PROJ_ID';
	const ESFU_QT_FUNCAO = 'ESFU_QT_FUNCAO';
	const ESFU_DT_CADASTRO = 'ESFU_DT_CADASTRO';
	const ESFU_DT_UPDATE = 'ESFU_DT_UPDATE';

	// Comandos DML
	const INS = 'INSERT INTO `' . self::TABELA . '` ('
				. '`USUA_ID`, '
				. '`PROJ_ID`, '
				. '`ESFU_NU_ANO`, '
				. '`ESFU_NU_MES`, '
				. '`ESFU_NU_DIA`, '
				. '`ESFU_IN_TIPO` '
				. ') VALUES (?,?,?,?,?,?)';

	const DEL_PK = 'DELETE ';

	const UPD = 'UPDATE `' . self::TABELA . '` set ';
	const UPD_INCREMENTA_PK = 'UPDATE `' . self::TABELA . '` set `ESFU_QT_FUNCAO` = `ESFU_QT_FUNCAO` + 1'
				. ' WHERE `ESFU_ID` = ?';
				
	const UPD_INCREMENTA_QTDE = 'UPDATE `' . self::TABELA . '` set `ESFU_QT_FUNCAO` = `ESFU_QT_FUNCAO` + 1'
				. ' WHERE `ESFU_NU_ANO` = ?'
				. ' AND `ESFU_NU_MES` = ?'
				. ' AND `ESFU_NU_DIA` = ?'
				. ' AND `ESFU_IN_TIPO` = ?'
				. ' AND `USUA_ID` = ?'
				. ' AND `PROJ_ID` = ?';

	const UPD_INCREMENTA_QTDE_ALTERNATIVA = 'UPDATE `' . self::TABELA . '` set `ESFU_QT_FUNCAO` = `ESFU_QT_FUNCAO` + ?'
				. ' WHERE `ESFU_NU_ANO` = ?'
				. ' AND `ESFU_NU_MES` = ?'
				. ' AND `ESFU_NU_DIA` = ?'
				. ' AND `ESFU_IN_TIPO` = ?'
				. ' AND `USUA_ID` = ?'
				. ' AND `PROJ_ID` = ?';



	const SELECT = 'SELECT `ESFU_ID`,'
					. ' `ESFU_NU_ANO`, '
					. ' `ESFU_NU_MES`, '
					. ' `ESFU_NU_DIA`, '
					. ' `ESFU_IN_TIPO`, '
					. ' `USUA_ID`, '
					. ' `PROJ_ID`, '
					. ' `ESFU_QT_FUNCAO`,'
					. ' `ESFU_DT_CADASTRO`,'
					. ' `ESFU_DT_UPDATE` '
					. ' FROM `'.self::TABELA.'` ';

	const SELECT_COUNT = 'SELECT count(*) FROM `'.self::TABELA.'` ';

	const WHERE_PK = self::SELECT . ' WHERE `' . self::ESFU_ID . '` = ?';
	const WHERE_UIX = self::SELECT 
				. ' WHERE `ESFU_NU_ANO` = ?'
				. ' AND `ESFU_NU_MES` = ?'
				. ' AND `ESFU_NU_DIA` = ?'
				. ' AND `ESFU_IN_TIPO` = ?'
				. ' AND `USUA_ID` = ?'
				. ' AND `PROJ_ID` = ?';

/*
* addSufixo - Adiciona um sufixo apontado por $texto
*/
	public static function addSufixo($conteudo, $tabela, $sufixo){
		return 	str_replace($tabela, $tabela . $sufixo, $conteudo);
	}
}
?>