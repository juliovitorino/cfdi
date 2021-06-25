
CREATE TABLE CAMPANHA_SORTEIO
(
    `CASO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da campanha sorteio',
    `CAMP_ID` int(11) NOT NULL COMMENT 'ID da campanha',
    `CASO_TX_NOME`  VARCHAR(100)  NOT NULL COMMENT 'Nome do sorteio',
    `CASO_TX_URL_REGULAMENTO`  VARCHAR(2000)  NOT NULL  COMMENT 'URL regulamento do sorteio',
    `CASO_TX_PREMIO`  VARCHAR(2000)  NOT NULL  COMMENT 'Prêmio do sorteio',
    `CASO_DT_INICIO`  timestamp NULL COMMENT 'Data de início',
    `CASO_DT_TERMINO`  timestamp NULL COMMENT 'Data de término',
    `CASO_NU_MAX_TICKET` int(11) NOT NULL DEFAULT 1000 COMMENT 'Máximo de tickets',
    `CASO_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P' COMMENT 'Status',
    `CASO_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CASO_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CASO_ID PRIMARY KEY(CASO_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CASO_CAMP_ID
        ON CAMPANHA_SORTEIO(CAMP_ID);

/* CAMPANHA X CAMPANHA SORTEIO */
ALTER TABLE CAMPANHA_SORTEIO
    ADD CONSTRAINT FK_CAMP_CASO
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;


CREATE TABLE CAMPANHA_SORTEIO_FILA_CRIACAO
(
    `CSFC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da campanha sorteio fila criação',
    `CASO_ID` int(11) NOT NULL COMMENT 'ID da campanha sorteio',
    `CSFC_QT_LOTE`  int(5) NOT NULL DEFAULT 0 COMMENT 'Nome do sorteio',
    `CSFC_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P' COMMENT 'Status',
    `CSFC_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CSFC_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CSFC_ID PRIMARY KEY(CSFC_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CSFC_CASO_ID
        ON CAMPANHA_SORTEIO_FILA_CRIACAO(CASO_ID);

/* CAMPANHA SORTEIO X CAMPANHA SORTEIO FILA CRIACAO */
ALTER TABLE CAMPANHA_SORTEIO_FILA_CRIACAO
    ADD CONSTRAINT FK_CASO_CSFC
    FOREIGN KEY (CASO_ID) 
    REFERENCES CAMPANHA_SORTEIO(CASO_ID) ON DELETE CASCADE;   



CREATE TABLE CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS
(
    `CSNP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da CSNP',
    `CASO_ID` int(11) NOT NULL COMMENT 'ID da campanha sorteio',
    `CSNP_NU_SORTEIO`  int(5) NOT NULL DEFAULT 0 COMMENT 'Número ticket de sorteio',
    `CSNP_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `CSNP_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CSNP_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CSNP_ID PRIMARY KEY(CSNP_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CSNP_CASO_ID
        ON CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS(CASO_ID);


ALTER TABLE CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS
    ADD CONSTRAINT FK_CASO_CSNP
    FOREIGN KEY (CASO_ID)
    REFERENCES CAMPANHA_SORTEIO(CASO_ID) ON DELETE CASCADE;


CREATE TABLE `USUARIO_CAMPANHA_SORTEIO` (
    `USCS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuario Campanha Sorteio',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `CASO_ID` int(11) NOT NULL COMMENT 'ID Campanha Sorteio',
    `USCS_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
    `USCS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `USCS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_USCS_ID PRIMARY KEY (USCS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_USCS_CASO_ID
        ON USUARIO_CAMPANHA_SORTEIO(CASO_ID);

CREATE INDEX IX_USCS_USUA_ID
        ON USUARIO_CAMPANHA_SORTEIO(USUA_ID);

ALTER TABLE USUARIO_CAMPANHA_SORTEIO
    ADD CONSTRAINT FK_USCS_CASO
    FOREIGN KEY (CASO_ID)
    REFERENCES CAMPANHA_SORTEIO(CASO_ID) ON DELETE CASCADE;

ALTER TABLE USUARIO_CAMPANHA_SORTEIO
    ADD CONSTRAINT FK_USCS_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;



CREATE TABLE `USUARIO_CAMPANHA_SORTEIO_TICKETS` (
    `UCST_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuario Campanha Sorteio Ticket',
    `USCS_ID` int(11) NOT NULL COMMENT 'ID Usuario Campanha Sorteio',
    `UCST_NU_TICKET` int(11) NOT NULL DEFAULT 0 COMMENT 'Número do Ticket',
    `UCST_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
    `UCST_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `UCST_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_UCST_ID PRIMARY KEY (UCST_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_UCST_USCS_ID
        ON USUARIO_CAMPANHA_SORTEIO_TICKETS(USCS_ID);    
        
ALTER TABLE USUARIO_CAMPANHA_SORTEIO_TICKETS
    ADD CONSTRAINT FK_UCST_USCS
    FOREIGN KEY (USCS_ID)
    REFERENCES USUARIO_CAMPANHA_SORTEIO(USCS_ID) ON DELETE CASCADE;


CREATE TABLE `REGISTRO_INDICACAO` (
 `REIN_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Registro Indicação',
 `USUA_ID_PROMOTOR` int(11) NOT NULL COMMENT 'ID do usuário Promotor',
 `USUA_ID_INDICADO` int(11) NOT NULL COMMENT 'ID do usuário Indicado',
 `REIN_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `REIN_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `REIN_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_REIN_ID PRIMARY KEY (REIN_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UIX_FIPO_USUA_ID
        ON REGISTRO_INDICACAO(USUA_ID_PROMOTOR, USUA_ID_INDICADO);

ALTER TABLE REGISTRO_INDICACAO
    ADD CONSTRAINT FK_REIN_USUA_ID_P
    FOREIGN KEY (USUA_ID_PROMOTOR)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE REGISTRO_INDICACAO
    ADD CONSTRAINT FK_REIN_USUA_ID_I
    FOREIGN KEY (USUA_ID_INDICADO)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;
    


ALTER TABLE `PLANO_USUARIO_FATURA` MODIFY COLUMN `PLUF_DT_PGTO` TIMESTAMP NOT NULL;
ALTER TABLE `CAMPANHA` ADD COLUMN `CAMP_IN_PERM_CSJ10` VARCHAR(1) NOT NULL DEFAULT 'N' COMMENT 'Permite participar de uma campanha sorteio do J10';
-- DML
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('FATOR_DIVISAO_TICKETS_EM_LOTES','Fator de divisão em lotes para produzir tickets de sorteio','100');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_PERMITIR_CAMPANHA_SORTEIO_J10_PARALELA','Chave Geral permitir campanha sorteio J10 em paralelo com clientes','OFF');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CODIGO_CAMPANHA_SORTEIO_J10_PARALELA','Código da campanha sorteio J10 em paralelo com clientes','1170');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_INDICACAO_PERMITE_CAMPANHA_SORTEIO','Chave Geral Permissão para Ticket campanha sorteio indicação J10','OFF');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CODIGO_CAMPANHA_SORTEIO_ATIVO_INDICACAO','Código da campanha sorteio indicação do J10 para clientes','1170');

INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0144','Plano GRATUITO não permite criação de sorteios. Faça a migração para PLANO MEMBRO ou PREMIUM.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0145','Seu plano não permite criar sorteios. Faça a migração para PLANO MEMBRO ou PREMIUM.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0146','Não existem mais tickets para serem gerados na fila.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0147','Campanha sorteio não existe.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0148','Campanha sorteio precisa ser ativada para criar números.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0149','Campanha sorteio está finalizada.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0150','Foi incluida na campanha (*=p1=*) *=p2=* uma nova campanha de sorteio (*=p3=*) *=p4=*. Status = *=p5=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0151','A Campanha sorteio precisa estar com status (W) = Executando');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0152','Foi incluida campanha de sorteio (*=p1=*) *=p2=* *=p4=* tickets aleatórios. Status = *=p3=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0153','A criação de tickets da campanha de sorteio (*=p1=*) *=p2=* foi finalizada total de *=p4=* tickets criados. Status = *=p3=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0154','A campanha sorteio está pronta pra uso');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0155','A campanha sorteio foi ATIVADA COM SUCESSO e aguarda verificação. Em até 24h estará liberada.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0156','O status da campanha sorteio precisa ser verficado. Status = *=p1=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0157','O status da campanha sorteio (*=p1=*) *=p2=* precisa ser verficado pelo ADMIN. Status = *=p3=*');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0158','A campanha sorteio já está ATIVADA e funcionando.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0159','Não é permitido ativar campanhas sorteio simultaneamente. Pause a campanha Ativa.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0160','Não existe campanha sorteio para pausar');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0161','A campanha sorteio já está INATIVA.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0162','Seu plano permite no máximo *=p1=* sorteios promocionais por campanha. Faça uma migração de plano Membro ou Premium.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0163','Seu plano permite no máximo *=p1=* campanha(s). Faça uma migração de plano Membro ou Premium.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0164','Os cartões digitais do fornecedor ACABARAM (Máximo *=p1=* cartões). Peça para ele(a) recarregar os cartões ou trocar para um plano MEMBRO ou PREMIUM.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0165','Tentativa Negada. É proibida a auto-indicação da plataforma Junta10.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0166','Tentativa Negada. Usuário já foi indicado por outra pessoa.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0167','Tentativa Negada. Usuário já foi indicado por você.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0168','O usuário *=p1=* acaba de indicar *=p2=*');


-- ajustes nas permissões (*deprecated em tipos MX)

update `PLANOS`
set PLAN_TX_PERMISSAO = 'SLI00001SLI00010SLI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000'
where PLAN_ID = 2;



update `PLANO_USUARIO`
set PLUS_TX_PERMISSAO = 'SLI00001SLI00010SLI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000'
where PLAN_ID = 2;