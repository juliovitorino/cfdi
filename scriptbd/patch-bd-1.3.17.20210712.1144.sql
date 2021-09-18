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
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('EMAIL_SUPORTE_JUNTA10','Conta de email responder pelo suporte' ,'suporte@junta10.com');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('EMAIL_SUPORTE_JUNTA10_SENHA','Senha Conta de email responder pelo suporte (Não é senha server SMTP)' ,'aXB28@GIVfv*');


/*

##     ##  ######   ######   
###   ### ##    ## ##    ##  
#### #### ##       ##        
## ### ##  ######  ##   #### 
##     ##       ## ##    ##  
##     ## ##    ## ##    ##  
##     ##  ######   ######   
*/
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0204','O plano contratado não permite cartões com *=p1=* selos. Faça a migração para um plano adequado');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0205','O plano contratado não permite autorizadores terceiros. Faça a migração para um plano adequado');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0206','O plano contratado permite máximo de *=p1=* autorizadores terceiros. Faça a migração para um plano adequado');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0207','O plano contratado não tem permissão criar autorizadores terceiros. Faça a migração para um plano adequado');

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
 `FIEM_NM_DESTINATARIO` VARCHAR(200) NOT NULL COMMENT 'Nome do usuário destino',
 `FIEM_TX_EMAIL_PARA` VARCHAR(200) NOT NULL COMMENT 'Email do usuário destino',
 `FIEM_TX_ASSUNTO` VARCHAR(1000) NOT NULL COMMENT 'Asssunto da mensagem',
 `FIEM_IN_PRIOR` VARCHAR(2) NOT NULL DEFAULT 'NO' COMMENT 'Nível de prioridade da mensagem',
 `FIEM_TX_TEMPLATE` VARCHAR(1000) NOT NULL COMMENT 'Template associado a essa mensagem',
 `FIEM_NU_MAX_TENTATIVA` INT(2) NOT NULL DEFAULT 1 COMMENT 'Numero Max Tentativas',
 `FIEM_NU_TENTATIVA_REAL` INT(2) NOT NULL DEFAULT 0 COMMENT 'Numero Tentativas Realizadas',
 `FIEM_DT_PREV_ENVIO` DATE DEFAULT NULL COMMENT 'Data prevista envio',
 `FIEM_DT_REAL_ENVIO` TIMESTAMP NULL DEFAULT NULL COMMENT 'Data envio real',
 `FIEM_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `FIEM_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `FIEM_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_FIEM_ID PRIMARY KEY (FIEM_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* RECURSO                                                        */
/******************************************************************/
/* Valores para RECU_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `RECURSO` (
 `RECU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID recurso',
 `RECU_TX_DESCRICAO` VARCHAR(100) NOT NULL COMMENT 'Descrição',
 `RECU_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `RECU_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `RECU_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_RECU_ID PRIMARY KEY (RECU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* PLANO X RECURSO                                                 /
/******************************************************************/
CREATE TABLE `PLANO_RECURSO` (
    `PLRE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID plano x recurso',
    `PLAN_ID` int(11) NOT NULL COMMENT 'ID do plano',
    `RECU_ID` int(11) NOT NULL COMMENT 'ID recurso',
    `PLRE_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `PLRE_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `PLRE_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_PLRE_ID PRIMARY KEY (PLRE_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UIX_PLRE_USUA_RECU ON PLANO_RECURSO(PLAN_ID, RECU_ID);
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

 /* adicionar coluna */
ALTER TABLE CAMPANHA_QRCODES ADD COLUMN `CAQR_TX_QRCODEP` VARCHAR(100) NOT NULL DEFAULT 'X'  COMMENT 'qrcode impressão';


/* CONSTRAINTS PLANO_RECURSO X PLANO X RECURSO */
ALTER TABLE `PLANO_RECURSO` 
    ADD CONSTRAINT FK_PLRE_PLAN
    FOREIGN KEY (PLAN_ID)
    REFERENCES PLANOS(PLAN_ID) ON DELETE CASCADE;

ALTER TABLE `PLANO_RECURSO` 
    ADD CONSTRAINT FK_PLRE_RECU
    FOREIGN KEY (RECU_ID)
    REFERENCES RECURSO(RECU_ID) ON DELETE CASCADE;

/*
#### ##    ##  ######  ######## ########  ########  ######  
 ##  ###   ## ##    ## ##       ##     ##    ##    ##    ## 
 ##  ####  ## ##       ##       ##     ##    ##    ##       
 ##  ## ## ##  ######  ######   ########     ##     ######  
 ##  ##  ####       ## ##       ##   ##      ##          ## 
 ##  ##   ### ##    ## ##       ##    ##     ##    ##    ## 
#### ##    ##  ######  ######## ##     ##    ##     ######  
*/

/* consertar a tabela USUARIO_COMPLEMENTO em relação ao status atual */
insert into `USUARIO_COMPLEMENTO` (USUA_ID)
select USUA_ID from `USUARIO`;

/*

##     ## ########  ########     ###    ######## ########  ######  
##     ## ##     ## ##     ##   ## ##      ##    ##       ##    ## 
##     ## ##     ## ##     ##  ##   ##     ##    ##       ##       
##     ## ########  ##     ## ##     ##    ##    ######    ######  
##     ## ##        ##     ## #########    ##    ##             ## 
##     ## ##        ##     ## ##     ##    ##    ##       ##    ## 
 #######  ##        ########  ##     ##    ##    ########  ######  

 */
UPDATE PLANOS SET
PLAN_TX_PERMISSAO = 'SLI99999SLI99999SLI00000ILI00000ILI00000SLI00000SLI00005SLI00010SLI00012SLI00015SLI00020SLI99999SLI99999ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000'
WHERE PLAN_ID = 1006;
 
/* consertar os qrcodes para novo proposito */
UPDATE CAMPANHA_QRCODES SET CAQR_TX_QRCODEP = concat('02',`CAQR_TX_QRCODE`) WHERE CAQR_IN_STATUS = 'A';
UPDATE CAMPANHA_QRCODES SET CAQR_TX_QRCODE = concat('01',`CAQR_TX_QRCODE`) WHERE CAQR_IN_STATUS = 'A'; 
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


 INSERT INTO VERSAO ( 
	`VERS_TX_VERSAO`,
	`VERS_TX_FRONTEND`,
	`VERS_TX_BACKEND`,
	`VERS_TX_BD`
) VALUES ('1.4.8.5.20210906.1129','1.4.8.5.20210906.1129','1.4.8.5.20210906.1129','1.4.8.5.20210906.1129'); 



/*indicces */
CREATE INDEX IX_CAQR_TX_QRCODE
       ON CAMPANHA_QRCODES(CAQR_TX_QRCODE);

CREATE INDEX IX_CAQR_TX_QRCODEP
       ON CAMPANHA_QRCODES(CAQR_TX_QRCODEP);

