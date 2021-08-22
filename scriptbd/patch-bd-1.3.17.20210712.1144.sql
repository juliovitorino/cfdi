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
-- NÃO EESQUECER DE AJUSTAR A TABELA VARIAVEIS
----------------------------------------------------------------------------------
=> Conferir o arquivo "variaveis-ajustar-import.txt"

-- *****  É OBRIGATORIO CRIAR UM REGISTRO USCA PARA CADA DONO DE CAMPANHA NESSA NOVA VERSÃO *****
INSERT INTO USUARIO_CASHBACK ( 
  `USUA_ID`,
  `USCA_VL_RESGATE`,
  `USCA_VL_PERC_CASHBACK`,
  `USCA_IN_PERM_RESGATE_PIX`)
SELECT DISTINCT USUA_ID,100,1,'S'
FROM CAMPANHA
WHERE CAMP_IN_STATUS = 'A'
ORDER BY USUA_ID;
--********** NÃO ESQUEÇA DE APAGAR AS LINHAS DUPLICADAS DOS USUA_ID 1000 (JUNTA10) E 1 (JULIO) ****

/*
##     ##    ###    ########  ####    ###    ##     ## ######## ##       
##     ##   ## ##   ##     ##  ##    ## ##   ##     ## ##       ##       
##     ##  ##   ##  ##     ##  ##   ##   ##  ##     ## ##       ##       
##     ## ##     ## ########   ##  ##     ## ##     ## ######   ##       
 ##   ##  ######### ##   ##    ##  #########  ##   ##  ##       ##       
  ## ##   ##     ## ##    ##   ##  ##     ##   ## ##   ##       ##       
   ###    ##     ## ##     ## #### ##     ##    ###    ######## ######## 
   */
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_PERMITE_REMUNERAR_PROMOTOR','Chave Geral para permitir remunerar um promotor de usuarios que criam campanha' ,'ON');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_REMUNERAR_PROMOTOR','Valor a remunerar um promotor de usuarios que criam campanha' ,'2.55');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DEBITAR_REMUNERAR_PROMOTOR','USUA_ID que vai remunerar um promotor de usuarios que criam campanha' ,'1');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO','Chave Geral para permitir remunerar um novo usuário na plataforma' ,'ON');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_REMUNERAR_NOVO_USUARIO','Valor a remunerar um novo usuário na plataforma' ,'5.00');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DEBITAR_REMUNERAR_NOVO_USUARIO','USUA_ID que vai remunerar o novo usuário na plataforma' ,'1');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DOMINADOR_SALDO_FPGL','Usuário dominador do Tipo movimento SALDO' ,'1');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_FUNDO_PARTICIPACAO_GLOBAL_FPGL','Chave Geral para uso do Fundo de Participação Global' ,'ON');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL','Valor padrão de retirada do Fundo de Participação Global' ,'0.50');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_INCENTIVAR_DONO_CAMPANHA_CARIMBAR','Chave Geral para permitir remunerar incentivo de dono de campanha' ,'OFF');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_INCENTIVAR_DONO_CAMPANHA_CARIMBAR','Valor padrão para remunerar incentivo de dono de campanha' ,'0.50');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_LIMITE_TETO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR','Valor limite teto remunerar incentivo de dono de campanha' ,'100');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DEBITO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR','USUA_ID debitar da configuração do cashback (USCA) incentivo de dono de campanha' ,'1');

/*

##     ##  ######   ######   
###   ### ##    ## ##    ##  
#### #### ##       ##        
## ### ##  ######  ##   #### 
##     ##       ## ##    ##  
##     ## ##    ## ##    ##  
##     ##  ######   ######   
*/
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0192','Crédito de bonificação por seu indicado acbar de criar uma campanha');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0193','Olá *=p1=*, você acaba de receber um CRÉDITO de *=p2=* no seu cashback porque o usuário *=p3=* acabou de criar uma campanha no Junta10 ');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0194','Crédito de bonificação por instalar o aplicativo Junta10. Parabéns!');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0195','Olá *=p1=*, você acaba de receber um CRÉDITO de *=p2=* no seu cashback por você ter instalado o aplicativo Junta10. Parabéns!');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0196','Aviso. Saldo Insuficiente para remunerar carimbo pelo Fundo de Participação Global');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0197','Valor inválido para lançamento no Fundo de Participação Global');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0198','Olá *=p1=*, você acaba de ser bonificado pelo nosso FPGL com um crédito de *=p2=* no seu cashback');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0199','Já existe lançamento em FPGL para USUA_ID = *=p1=* / PLUF_ID = *=p2=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0200','Plano atual do USUA_ID *=p1=* é gratuito. FPGL não permitido.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0201','Parabéns, você acaba de ganhar *=p1=* de crédito no seu cashback por incentivar seus clientes a participarem da campanha *=p2=*');


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
/*************************************************************************/
/* FUNDO_PARTICIPACAO_GLOBAL                                             */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
/* Valores para _IN_TIPO                                                  /
/* C=CREDITO | D=DEBITO | S=SALDO                                        */
/*************************************************************************/
CREATE TABLE `FUNDO_PARTICIPACAO_GLOBAL` (
 `FPGL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da Conta Corrente Cashback',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário participante',
 `USUA_ID_BONIFICADO` int(11) NULL COMMENT 'ID do usuário bonificado',
 `PLUF_ID` int(11) NULL COMMENT 'ID do plano fatura do usuário',
 `FPGL_IN_TIPO` varchar(1) NOT NULL DEFAULT 'C' COMMENT 'Tipo do movimento', 
 `FPGL_VL_TRANSACAO` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor do crédito ou débito',
 `FPGL_TX_DESCRICAO` varchar(500) NOT NULL COMMENT 'descrição',
 `FPGL_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `FPGL_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `FPGL_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_FPGL_ID PRIMARY KEY (FPGL_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;


CREATE INDEX IX_FPGL_USUA_PLUF_ID
        ON FUNDO_PARTICIPACAO_GLOBAL(USUA_ID, PLUF_ID);

/******************************************************************/
/* SEGLOG_FUNCOES_ADMINISTRATIVAS                                 */
/******************************************************************/
/* MNEMONICO = FUAD                                                /
/*-----------------------------------------------------------------/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `SEGLOG_FUNCOES_ADMINISTRATIVAS` (
 `FUAD_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID funções administrativas',
 `FUAD_NM_DESCRICAO` VARCHAR(100) NOT NULL COMMENT 'Descricao da função administrativa',
 `FUAD_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `FUAD_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `FUAD_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_FUAD_ID PRIMARY KEY (FUAD_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* SEGLOG_GRUPO_ADMINISTRACAO                                     */
/******************************************************************/
/* MNEMONICO = GRAD                                                /
/*-----------------------------------------------------------------/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `SEGLOG_GRUPO_ADMINISTRACAO` (
 `GRAD_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID grupo administração',
 `GRAD_NM_DESCRICAO` VARCHAR(100) NOT NULL COMMENT 'Descricao do grupo administração',
 `GRAD_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `GRAD_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `GRAD_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_GRAD_ID PRIMARY KEY (GRAD_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* SEGLOG_GRUPO_ADM_FUNCAO_ADM                                    */
/******************************************************************/
/* MNEMONICO = GAFA                                                /
/*-----------------------------------------------------------------/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `SEGLOG_GRUPO_ADM_FUNCAO_ADM` (
 `GAFA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID grupo admin x função admin',
 `GRAD_ID` int(11) NOT NULL COMMENT 'ID grupo administração',
 `FUAD_ID` int(11) NOT NULL COMMENT 'ID funções administrativas',
 `GAFA_NM_DESCRICAO` VARCHAR(100) NOT NULL COMMENT 'Descricao do grupo admin x função admin',
 `GAFA_IN_CRUD_CRIAR` VARCHAR(1) NOT NULL DEFAULT 'N' COMMENT 'Permissão CRUD Criar',
 `GAFA_IN_CRUD_RECUPERAR` VARCHAR(1) NOT NULL DEFAULT 'N' COMMENT 'Permissão CRUD Recuperar',
 `GAFA_IN_CRUD_ATUALIZAR` VARCHAR(1) NOT NULL DEFAULT 'N' COMMENT 'Permissão CRUD Atualizar',
 `GAFA_IN_CRUD_EXCLUIR` VARCHAR(1) NOT NULL DEFAULT 'N' COMMENT 'Permissão CRUD Excluir',
 `GAFA_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `GAFA_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `GAFA_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_GAFA_ID PRIMARY KEY (GAFA_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* SEGLOG_GRUPO_USUARIO                                           */
/******************************************************************/
/* MNEMONICO = GRUS                                                /
/*-----------------------------------------------------------------/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `SEGLOG_GRUPO_USUARIO` (
 `GRUS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID grupo admin x usuário',
 `GRAD_ID` int(11) NOT NULL COMMENT 'ID grupo administração',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `GRUS_IN_STATUS` VARCHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `GRUS_DT_CADASTRO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `GRUS_DT_UPDATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_GRUS_ID PRIMARY KEY (GRUS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;



ALTER TABLE `FUNDO_PARTICIPACAO_GLOBAL` 
    ADD CONSTRAINT FK_FPGL_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;
    
ALTER TABLE `FUNDO_PARTICIPACAO_GLOBAL` 
    ADD CONSTRAINT FK_FPGL_USUA_BON
    FOREIGN KEY (USUA_ID_BONIFICADO)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;
    
ALTER TABLE `FUNDO_PARTICIPACAO_GLOBAL` 
    ADD CONSTRAINT FK_FPGL_PLUF
    FOREIGN KEY (PLUF_ID)
    REFERENCES PLANO_USUARIO_FATURA(PLUF_ID) ON DELETE CASCADE;



/* CONSTRAINTS DE SEGLOG */

ALTER TABLE `SEGLOG_GRUPO_ADM_FUNCAO_ADM` 
    ADD CONSTRAINT FK_GAFA_GRAD
    FOREIGN KEY (GRAD_ID)
    REFERENCES SEGLOG_GRUPO_ADMINISTRACAO(GRAD_ID) ON DELETE CASCADE;
    
ALTER TABLE `SEGLOG_GRUPO_ADM_FUNCAO_ADM` 
    ADD CONSTRAINT FK_GAFA_FUAD
    FOREIGN KEY (FUAD_ID)
    REFERENCES SEGLOG_FUNCOES_ADMINISTRATIVAS(FUAD_ID) ON DELETE CASCADE;

ALTER TABLE `SEGLOG_GRUPO_USUARIO`
    ADD CONSTRAINT FK_GRUS_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE `SEGLOG_GRUPO_USUARIO`
    ADD CONSTRAINT FK_GRUS_GRAD
    FOREIGN KEY (GRAD_ID)
    REFERENCES SEGLOG_GRUPO_ADMINISTRACAO(GRAD_ID) ON DELETE CASCADE;


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

ALTER TABLE USUARIO_CASHBACK 
MODIFY COLUMN USCA_IN_PERM_RESGATE_PIX VARCHAR(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Permite solicitar resgate via PIX';

ALTER TABLE CAMPANHA
ADD COLUMN CAMP_IN_PERM_BONIF_DONO_CAMP varchar(1)  NOT NULL DEFAULT 'S' COMMENT 'Permite bonificar financeiramento donos de campanha';


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

/* -- SEGLOG -- */
CREATE VIEW VW_SEGLOG
AS
SELECT GAFA.GAFA_ID AS SELOG_ID
, GRUS.USUA_ID as USUA_ID
, FUAD.FUAD_NM_DESCRICAO AS SEGLOG_DESCRICAO
, GAFA.GAFA_IN_CRUD_CRIAR AS SEGLOG_IN_CRUD_CRIAR
, GAFA.GAFA_IN_CRUD_RECUPERAR AS SEGLOG_IN_CRUD_RECUPERAR
, GAFA.GAFA_IN_CRUD_ATUALIZAR AS SEGLOG_IN_CRUD_ATUALIZAR
, GAFA.GAFA_IN_CRUD_EXCLUIR AS SEGLOG_IN_CRUD_EXCLUIR
, GAFA.GAFA_IN_STATUS as SEGLOG_IN_STATUS
, GAFA.GAFA_DT_CADASTRO as SEGLOG_DT_CADASTRO
, GAFA.GAFA_DT_UPDATE SEGLOG_DT_UPDATE
FROM SEGLOG_GRUPO_ADM_FUNCAO_ADM GAFA 
INNER JOIN SEGLOG_FUNCOES_ADMINISTRATIVAS FUAD ON FUAD.FUAD_ID = GAFA.FUAD_ID
INNER JOIN SEGLOG_GRUPO_ADMINISTRACAO GRAD ON GRAD.GRAD_ID = GAFA.GRAD_ID
INNER JOIN SEGLOG_GRUPO_USUARIO GRUS ON GRUS.GRAD_ID = GRAD.GRAD_ID
