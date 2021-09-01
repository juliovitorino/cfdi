/*

   ###    ######## ######## ##    ##  ######     ###     #######  
  ## ##      ##    ##       ###   ## ##    ##   ## ##   ##     ## 
 ##   ##     ##    ##       ####  ## ##        ##   ##  ##     ## 
##     ##    ##    ######   ## ## ## ##       ##     ## ##     ## 
#########    ##    ##       ##  #### ##       ######### ##     ## 
##     ##    ##    ##       ##   ### ##    ## ##     ## ##     ## 
##     ##    ##    ######## ##    ##  ######  ##     ##  ####### 
 
 */

----------------------------------------------------------------------------------
-- NÃO ESQUECER DE AJUSTAR A TABELA VARIAVEIS QUANDO IMPORTAR O BANCO DE PRODUCAO
-- PARA DENTRO DE DSV OU HMG
----------------------------------------------------------------------------------
=> Conferir o arquivo "variaveis-ajustar-import.txt"


/*
##     ##    ###    ########  ####    ###    ##     ## ######## ##       
##     ##   ## ##   ##     ##  ##    ## ##   ##     ## ##       ##       
##     ##  ##   ##  ##     ##  ##   ##   ##  ##     ## ##       ##       
##     ## ##     ## ########   ##  ##     ## ##     ## ######   ##       
 ##   ##  ######### ##   ##    ##  #########  ##   ##  ##       ##       
  ## ##   ##     ## ##    ##   ##  ##     ##   ## ##   ##       ##       
   ###    ##     ## ##     ## #### ##     ##    ###    ######## ######## 
   */


/*

##     ##  ######   ######   
###   ### ##    ## ##    ##  
#### #### ##       ##        
## ### ##  ######  ##   #### 
##     ##       ## ##    ##  
##     ## ##    ## ##    ##  
##     ##  ######   ######   
*/

/*

########  ########  ##       
##     ## ##     ## ##       
##     ## ##     ## ##       
##     ## ##     ## ##       
##     ## ##     ## ##       
##     ## ##     ## ##       
########  ########  ######## 

*/

-- Atualização estrutural de tabelas e campos
/******************************************************************/
/* FILA_EMAIL                                                     */
/******************************************************************/
/* Valores para FIEM_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
/* Valores para FIEM_IN_PRIOR                                      /
/* HI = Alta  (High)                                               /
/* NO = Normal                                                     /
/* LO = Baixa (low)                                                /
/******************************************************************/
CREATE TABLE `FILA_EMAIL` (
 `FIEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID fila email',
 `FIEM_NM_FILA` VARCHAR(100) NOT NULL COMMENT 'Nome da fila',
 `FIEM_TX_EMAIL_DE` VARCHAR(200) NOT NULL COMMENT 'Email do usuário de',
 `FIEM_TX_EMAIL_PARA` VARCHAR(200) NOT NULL COMMENT 'Email do usuário destino',
 `FIEM_TX_ASSUNTO` VARCHAR(1000) NOT NULL COMMENT 'Asssunto da mensagem',
 `FIEM_IN_PRIOR` VARCHAR(2) NOT NULL DEFAULT 'NO' COMMENT 'Nível de prioridade da mensagem',
 `FIEM_TX_TEMPLATE` VARCHAR(1000) NOT NULL COMMENT 'Template associado a essa mensagem',
 `FIEM_NU_MAX_TENTATIVA` INT(2) NOT NULL DEFAULT 1 COMMENT 'Numero Max Tentativas',
 `FIEM_NU_TENTATIVA_REAL` INT(2) NOT NULL DEFAULT 1 COMMENT 'Numero Tentativas Realizadas',
 `FIEM_DT_PREV_ENVIO` DATE DEFAULT NULL COMMENT 'Data prevista envio',
 `FIEM_DT_REAL_ENVIO` TIMESTAMP NULL DEFAULT NULL COMMENT 'Data envio real',
 `FIEM_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `FIEM_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `FIEM_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_FIEM_ID PRIMARY KEY (FIEM_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;


/* 


   ###    ##       ######## ######## ########  
  ## ##   ##          ##    ##       ##     ## 
 ##   ##  ##          ##    ##       ##     ## 
##     ## ##          ##    ######   ########  
######### ##          ##    ##       ##   ##   
##     ## ##          ##    ##       ##    ##  
##     ## ########    ##    ######## ##     ## 


########    ###    ########  ##       ######## 
   ##      ## ##   ##     ## ##       ##       
   ##     ##   ##  ##     ## ##       ##       
   ##    ##     ## ########  ##       ######   
   ##    ######### ##     ## ##       ##       
   ##    ##     ## ##     ## ##       ##       
   ##    ##     ## ########  ######## ######## 

 */


/*

##     ## ########  ########     ###    ######## ########  ######  
##     ## ##     ## ##     ##   ## ##      ##    ##       ##    ## 
##     ## ##     ## ##     ##  ##   ##     ##    ##       ##       
##     ## ########  ##     ## ##     ##    ##    ######    ######  
##     ## ##        ##     ## #########    ##    ##             ## 
##     ## ##        ##     ## ##     ##    ##    ##       ##    ## 
 #######  ##        ########  ##     ##    ##    ########  ######  

 */
 
/*

##     ## #### ######## ##      ## 
##     ##  ##  ##       ##  ##  ## 
##     ##  ##  ##       ##  ##  ## 
##     ##  ##  ######   ##  ##  ## 
 ##   ##   ##  ##       ##  ##  ## 
  ## ##    ##  ##       ##  ##  ## 
   ###    #### ########  ###  ###  
*/



/*

##     ## ######## ########   ######     ###     #######  
##     ## ##       ##     ## ##    ##   ## ##   ##     ## 
##     ## ##       ##     ## ##        ##   ##  ##     ## 
##     ## ######   ########   ######  ##     ## ##     ## 
 ##   ##  ##       ##   ##         ## ######### ##     ## 
  ## ##   ##       ##    ##  ##    ## ##     ## ##     ## 
   ###    ######## ##     ##  ######  ##     ##  #######  
*/

/*
 INSERT INTO VERSAO ( 
	`VERS_TX_VERSAO`,
	`VERS_TX_FRONTEND`,
	`VERS_TX_BACKEND`,
	`VERS_TX_BD`
) VALUES ('1.4.7.5.20210824.0720','1.4.7.5.20210824.0720','1.4.7.5.20210824.0720','1.4.7.5.20210824.0720'); 

*/
