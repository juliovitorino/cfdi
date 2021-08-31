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
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0202','Obrigado por entrar em contato. Responderemos a sua solictação o mais breve possível.');

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
CREATE TABLE `CONTATO` (
 `CONT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID contato',
 `CONT_NM_NOME` VARCHAR(100) NOT NULL COMMENT 'Nome do usuário',
 `CONT_TX_EMAIL` VARCHAR(200) NOT NULL COMMENT 'Email do usuário',
 `CONT_TX_MENSAGEM` VARCHAR(2000) NOT NULL COMMENT 'Mensagem postada pelo usuário',
 `CONT_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `CONT_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CONT_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CONT_ID PRIMARY KEY (CONT_ID)
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
