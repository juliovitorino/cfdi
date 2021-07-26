....###....########.########.##....##..######.....###.....#######.
...##.##......##....##.......###...##.##....##...##.##...##.....##
..##...##.....##....##.......####..##.##........##...##..##.....##
.##.....##....##....######...##.##.##.##.......##.....##.##.....##
.#########....##....##.......##..####.##.......#########.##.....##
.##.....##....##....##.......##...###.##....##.##.....##.##.....##
.##.....##....##....########.##....##..######..##.....##..#######.

----------------------------------------------------------------------------------
-- SCRIPTS NAS TABELAS VARIAVEL E MENSAGEM DEVEM SER RODADOS EM TODOS OS AMBIENTES
----------------------------------------------------------------------------------

-- Atualização estrutural de tabelas e campos
ALTER TABLE `CAMPANHA` MODIFY COLUMN `CAMP_DT_TERMINO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de término';
ALTER TABLE `CAMPANHA` ADD COLUMN `CAMP_IN_PERM_MOVER_CART` VARCHAR(1) NOT NULL DEFAULT 'S' COMMENT 'Permite mover cartão outro usuário';

/******************************************************************/
/* CARTAO_MOVER_HISTORICO - HISTORICO DE TRANSFERENCIA DE CARTAO  */
/******************************************************************/
CREATE TABLE `CARTAO_MOVER_HISTORICO` (
 `CAMH_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do hsitorico cartão transferido',
 `CART_ID` int(11) NOT NULL COMMENT 'ID do cartão',
 `USUA_ID_DE` int(11) NOT NULL COMMENT 'ID do usuário doador',
 `USUA_ID_PARA` int(11) NOT NULL COMMENT 'ID do usuário receptor',
 `CAMH_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status do cartão',
 `CAMH_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CAMH_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CAMH_ID PRIMARY KEY (CAMH_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

ALTER TABLE CARTAO_MOVER_HISTORICO 
    ADD CONSTRAINT FK_CAMH_CART
    FOREIGN KEY (CART_ID)
    REFERENCES CARTAO(CART_ID) ON DELETE CASCADE;

ALTER TABLE CARTAO_MOVER_HISTORICO
    ADD CONSTRAINT FK_CAMH_USUA_ID_DE
    FOREIGN KEY (USUA_ID_DE)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE CARTAO_MOVER_HISTORICO
    ADD CONSTRAINT FK_CAMH_USUA_ID_PARA
    FOREIGN KEY (USUA_ID_PARA)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

CREATE TABLE `CAMPANHA_CASHBACK_RESGATE_PIX` (
 `CCRP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Resgate Cashback',
 `CACA_ID` int(11) NOT NULL COMMENT 'ID Campanha x Cashback',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário solicitante',
 `CCRP_IN_TIPO_CHAVE_PIX` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Tipo da Chave PIX',
 `CCRP_TX_CHAVE_PIX` varchar(100) NOT NULL COMMENT 'Chave PIX',
 `CCRP_VL_RESGATE` DECIMAL(11,2) NOT NULL DEFAULT 0 COMMENT 'Valor Pretendido a Resgatar',
 `CCRP_TX_AUTENT_BCO` varchar(200) DEFAULT NULL COMMENT 'Autenticação do Banco',
 `CCRP_IN_ESTAGIO_RT` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Estágio Real Time',
 `CCRP_DT_ESTAGIO_ANALISE` timestamp NULL COMMENT 'Data Registro Estágio Análise',
 `CCRP_DT_ESTAGIO_FINANCEIRO` timestamp NULL COMMENT 'Data Registro Estágio Financeiro',
 `CCRP_DT_ESTAGIO_ERRO` timestamp NULL COMMENT 'Data Registro Estágio Erro',
 `CCRP_DT_ESTAGIO_TRANSF_BCO` timestamp NULL COMMENT 'Data Registro Estágio Transferido Bco',
 `CCRP_TX_LIVRE_ESTAGIO_RT` varchar(2000) DEFAULT NULL COMMENT 'Texto Livre do Estagio RT',
 `CCRP_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `CCRP_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CCRP_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CCRP_ID PRIMARY KEY (CCRP_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/* CASHBACK_RESGATE_PIX */
ALTER TABLE CAMPANHA_CASHBACK_RESGATE_PIX 
    ADD CONSTRAINT FK_CCRP_CACA
    FOREIGN KEY (CACA_ID)
    REFERENCES CAMPANHA_CASHBACK(CACA_ID) ON DELETE CASCADE;

ALTER TABLE CAMPANHA_CASHBACK_RESGATE_PIX
    ADD CONSTRAINT FK_CCRP_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;
