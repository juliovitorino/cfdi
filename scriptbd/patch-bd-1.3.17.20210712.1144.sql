....###....########.########.##....##..######.....###.....#######.
...##.##......##....##.......###...##.##....##...##.##...##.....##
..##...##.....##....##.......####..##.##........##...##..##.....##
.##.....##....##....######...##.##.##.##.......##.....##.##.....##
.#########....##....##.......##..####.##.......#########.##.....##
.##.....##....##....##.......##...###.##....##.##.....##.##.....##
.##.....##....##....########.##....##..######..##.....##..#######.

----------------------------------------------------------------------------------
-- NÃO EESQUECER DE AJUSTAR A TABELA VARIAVEIS
----------------------------------------------------------------------------------
=> Conferir o arquivo "variaveis-ajustar-import.txt"

INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_PERMITE_REMUNERAR_PROMOTOR','Chave Geral para permitir remunerar um promotor de usuarios que criam campanha' ,'ON');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_REMUNERAR_PROMOTOR','Valor a remunerar um promotor de usuarios que criam campanha' ,'2.55');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DEBITAR_REMUNERAR_PROMOTOR','USUA_ID que vai remunerar um promotor de usuarios que criam campanha' ,'1');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO','Chave Geral para permitir remunerar um novo usuário na plataforma' ,'ON');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_REMUNERAR_NOVO_USUARIO','Valor a remunerar um novo usuário na plataforma' ,'5.00');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('USUA_ID_DEBITAR_REMUNERAR_NOVO_USUARIO','USUA_ID que vai remunerar o novo usuário na plataforma' ,'1');

INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0192','Crédito de bonificação por seu indicado acbar de criar uma campanha');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0193','Olá *=p1=*, você acaba de receber um CRÉDITO de *=p2=* no seu cashback porque o usuário *=p3=* acabou de criar uma campanha no Junta10 ');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0194','Crédito de bonificação por instalar o aplicativo Junta10. Parabéns!');
INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0195','Olá *=p1=*, você acaba de receber um CRÉDITO de *=p2=* no seu cashback por você ter instalado o aplicativo Junta10. Parabéns!');

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


/* UPDATES NECESSÁRIOS */


