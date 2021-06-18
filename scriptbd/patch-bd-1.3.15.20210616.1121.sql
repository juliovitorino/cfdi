
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



ALTER TABLE `plano_usuario_fatura` MODIFY COLUMN `PLUF_DT_PGTO` TIMESTAMP NOT NULL;

-- DML
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('FATOR_DIVISAO_TICKETS_EM_LOTES','Fator de divisão em lotes para produzir tickets de sorteio','100');

INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0144','Plano GRATUITO não permite criação de sorteios. Faça a migração para PLANO MEMBRO ou PREMIUM.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0145','Seu plano não permite criar sorteios. Faça a migração para PLANO MEMBRO ou PREMIUM.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0146','Não existem mais tickets para serem gerados na fila.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0147','Campanha sorteio não existe.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0148','Campanha sorteio precisa ser ativada para criar números.');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0149','Campanha sorteio está finalizada.');

