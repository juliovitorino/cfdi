

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