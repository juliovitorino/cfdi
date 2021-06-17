/******************************************************************/
/* DDL para criação das tabelas do Linker                          /
/*                                                                 /
/* Autor.: Julio Cesar Vitorino                                    /
/* Data..: 01/06/2018 20:14                                        /
/* Data..: 01/04/2021 11:55                                        /
/* Versão: 1.3.15                                                  /
/*                                                                 /
/******************************************************************/
/* MySQL 5.7.19                                                    /
/* ----------------------------------------------------------------/
/* Database : cfd                                                  /
/* Acronimo : (C)artão de (F)idelidade (D)igital                   /
/******************************************************************/

/******************************************************************/
/* OBJETOS DE BANCO DE DADOS                                       /
/******************************************************************/
--
-- TABELAS DE USO COMUM EM QUALQUER SISTEMA
--

/******************************************************************/
/* USUARIO                                                        */
/******************************************************************/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* B = Bloqueado                                                   /
/* P = Pendente - Email enviado para assinante e aguardando sua    /
/*                confirmação do link. Registro permanece na base  /
/*                por 72 horas.                                    /
/* I = Inativado                                                   /
/******************************************************************/
/* Valores para USUA_IN_TIPO_CONTA                                 /
/* C = Membro                                                      /
/* A = Administrador                                               /
/* P = Premium                                                     /
/******************************************************************/
CREATE TABLE `USUARIO` (
 `USUA_ID` int(11) NOT NULL AUTO_INCREMENT,
 `USUA_TX_EMAIL` varchar(100)  NOT NULL,
 `USUA_TX_NOME` varchar(100)  NOT NULL,
 `USUA_TX_SENHA` varchar(100)  NOT NULL,
 `USUA_ID_USERFCBK` varchar(100),
 `USUA_TX_URLPICFCBK` varchar(2000) DEFAULT 'no-user.png',
 `USUA_IN_TIPO_CONTA` varchar(1) NOT NULL DEFAULT 'P',
 `USUA_TX_CODIGO_ATIVACAO` varchar(128) NOT NULL,
 `USUA_DT_CODIGO_ATIVACAO` timestamp,
 `USUA_IN_STATUS` varchar(1) NOT NULL DEFAULT 'P',
 `USUA_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `USUA_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT PK_USUA_USUA_ID PRIMARY KEY (USUA_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE  UNIQUE INDEX UN_TX_EMAIL
        ON USUARIO(USUA_TX_EMAIL);

CREATE  UNIQUE INDEX UN_TX_CODIGO_ATIVACAO
        ON USUARIO(USUA_TX_CODIGO_ATIVACAO);

CREATE INDEX IX_USUA_ID_USERFCBK
        ON USUARIO(USUA_ID_USERFCBK);

/******************************************************************/
/* USUARIO COMPLEMENTO                                            */
/******************************************************************/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE `USUARIO_COMPLEMENTO` (
 `USCO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do complemento',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `USCO_TX_DDD` varchar(2) COMMENT 'DDD',
 `USCO_TX_CEL` varchar(9) COMMENT 'Número Celular',
 `USCO_NM_RECEITA_FEDERAL` varchar(1000) COMMENT 'Nome registrado na Receita Federal',
 `USCO_NM_RESPONSAVEL` varchar(1000) COMMENT 'Nome do Responsável Principal',
 `USCO_TX_URL_WEBSITE` varchar(1000) COMMENT 'URL do Website',
 `USCO_TX_URL_FACEBOOK` varchar(1000) COMMENT 'URL do facebook',
 `USCO_TX_URL_INSTAGRAM` varchar(1000) COMMENT 'Conta Instagram',
 `USCO_TX_URL_PINTEREST` varchar(1000) COMMENT 'URL do Pinterest',
 `USCO_TX_URL_SKYPE` varchar(1000) COMMENT 'Apelido Skype',
 `USCO_TX_URL_TWITTER` varchar(1000) COMMENT 'Conta Twitter',
 `USCO_TX_URL_FACETIME` varchar(1000) COMMENT 'Conta Facetime',
 `USCO_TX_URL_IMG1` varchar(1000) COMMENT 'URL Foto Responsável',
 `USCO_TX_URL_IMG2` varchar(1000) COMMENT 'URL Foto 2',
 `USCO_TX_URL_IMG3` varchar(1000) COMMENT 'URL Foto 3',
 `USCO_TX_DESC_LIVRE` varchar(2000) COMMENT 'Descrição Livre',
 `USCO_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `USCO_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `USCO_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_USCO_ID PRIMARY KEY (USCO_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* PLANOS                                                          /
/******************************************************************/
/* Valores para PLAN_TX_PERMISSAO                                  /
/*                                                                 /
/* FORMATO: X XX 999 TAMANHO (6) POR PERMISSAO                     /
/*          | |  ---                                               /
/*          | |   |                                                /
/*          | |   |                                                /
/*          | |   +---> > 0 ... 999 = QUANTIDADE LIMITADA          /
/*          | |                                                    /
/*          | +-------> PERIODICIDADE                              /
/*          |           LI = LIVRE                                 /
/*          |           MX = MAXIMO                                /
/*          |           DD = DIARIA                                /
/*          |           SM = SEMANAL                               /
/*          |           QZ = QUINZENAL                             /
/*          |           MM = MENSAL                                /
/*          |           AA = ANUAL                                 /
/*          |                                                      /
/*          +-+---> (S) = SIM/PERMITIDO                            /
/*            +---> (N) = NÃO PERMITIVO                            /
/*            +---> (I) = INATIVO / SEM USO                        /
/*                                                                 /
/* ORDEM DE ARMAZENAMENTO DAS PERMISSÕES                           /
/* ----------------------                                          /
/* POS PERMISSAO                                                   /
/* --- ------------------                                          /
/* 0 - CRIAR CAMPANHA                                              /
/* 1 - MAXIMO CARTOES                                              /
/* 2 - PERM_CRIAR_PROMOCAO_PLANO                                   /
/* 3 - PERM_ADICIONAR_CARTOES_CAMPANHA                             /
/*                                                                 /
/******************************************************************/
/* Valores para PLAN_IN_STATUS                                     /
/* A = Ativo                                                       /
/* P = Pendente - Email enviado para assinante e aguardando sua    /
/*                confirmação do link. Registro permanece na base  /
/*                por 72 horas.                                    /
/* I = Inativado                                                   /
/******************************************************************/
/* Valores para PLAN_IN_TIPO                                       /
/* PLA = Plano Comum (de acordo com tabela de preços)              /
/* PUB = Planos de Publicidade/Promoção                            /
/* CRT = Plano de Venda de Adição de Cartões+Carimbos              /
/* CMP = Plano de Venda de Adição de campanhas                     /
/******************************************************************/
CREATE TABLE `PLANOS` (
    `PLAN_ID` int(11) NOT NULL AUTO_INCREMENT,
    `PLAN_NM_PLANO`  VARCHAR(100)  NOT NULL ,
    `PLAN_TX_PERMISSAO`  VARCHAR(2000)  NOT NULL DEFAULT 'ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000ILI00000' ,
    `PLAN_VL_PLANO` decimal(9,2)  NOT NULL,
    `PLAN_IN_TIPO` varchar(3)  NOT NULL DEFAULT 'PLA',
    `PLAN_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P',
    `PLAN_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `PLAN_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_PLAN_PLAN_ID PRIMARY KEY (PLAN_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* PLANO X USUARIO                                                 /
/******************************************************************/
CREATE TABLE `PLANO_USUARIO` (
    `PLUS_ID` int(11) NOT NULL AUTO_INCREMENT,
    `PLUS_ID_PARENT` int(11) NOT NULL DEFAULT 0,
    `USUA_ID` int(11) NOT NULL,
    `PLAN_ID` int(11) NOT NULL,
    `PLUS_NM_PLANO`  VARCHAR(100)  NOT NULL ,
    `PLUS_TX_PERMISSAO`  VARCHAR(2000)  NOT NULL ,
    `PLUS_VL_PLANO`  DECIMAL(10,2) NOT NULL DEFAULT 0,
    `PLUS_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P',
    `PLUS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `PLUS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_PLUS_PLUS_ID PRIMARY KEY (PLUS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_PLUS_USUA_ID
       ON PLANO_USUARIO(USUA_ID);


/******************************************************************/
/* PLANO USUARIO FATURA                                           */
/*                                                                */
/* PLUF_IN_STATUS                                                 */
/* P = Aguardando liberacao pelo sistema de pagamento pagseguro   */
/* L = Pagamento efetuado e liberado pelo pagseguro               */
/* R = Pagamento reprovador pelo pagseguro                        */
/* C = fatura cancelada                                           */
/* V = fatura vencida                                             */
/*                                                                */
/******************************************************************/
CREATE TABLE PLANO_USUARIO_FATURA
(
    `PLUF_ID`  int(11)  NOT NULL AUTO_INCREMENT,
    `PLUF_ID_PARENT` int(11) NOT NULL DEFAULT 0,
    `PLUS_ID` int(11) NOT NULL,
    `PLUF_VL_FATURA`  DECIMAL(10,2) NOT NULL,
    `PLUF_VL_DESCONTO`  DECIMAL(10,2) DEFAULT 0 NOT NULL,
    `PLUF_DT_VENCIMENTO` DATE NOT NULL,
    `PLUF_DT_PGTO` timestamp,
    `PLUF_IN_STATUS` VARCHAR(1) DEFAULT 'P' NOT NULL,
    `PLUF_DT_CADASTRO` timestamp DEFAULT CURRENT_TIMESTAMP  NOT NULL,
    `PLUF_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_PLUF_PLUF_ID PRIMARY KEY (PLUF_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* SESSAO                                                          /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/
CREATE TABLE `SESSAO` (
    `SESS_ID` int(11) NOT NULL AUTO_INCREMENT,
    `SESS_TX_HASH`  VARCHAR(100)  NOT NULL ,
    `USUA_ID` int(11) NOT NULL,
    `SESS_IN_MANTER_CONECTADO` varchar(1)  NOT NULL DEFAULT 'N',
    `SESS_IN_FORCAR_LOGIN` varchar(1)  NOT NULL DEFAULT 'N',
    `SESS_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `SESS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `SESS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_SESS_SESS_ID PRIMARY KEY (SESS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX UN_SESS_TX_HASH
       ON SESSAO(SESS_TX_HASH);

/******************************************************************/
/* TRACE                                                           /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/
CREATE TABLE `TRACE` (
    `TRAC_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TRAC_IN_TIPO`  VARCHAR(100)  NOT NULL ,
    `TRAC_TX_DESC` varchar(1000) NOT NULL,
    `TRAC_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `TRAC_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `TRAC_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_TRAC_ID PRIMARY KEY (TRAC_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE INDEX IX_TRAC_IN_TIPO
       ON TRACE(TRAC_IN_TIPO);


/******************************************************************/
/* TABELAS DE CONTROLE ESTATÍSTICO                                 /
/******************************************************************/
/* ESTATISTICA_FUNCAO                                              /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/
CREATE TABLE `ESTATISTICA_FUNCAO` (
    `ESFU_ID` int(11) NOT NULL AUTO_INCREMENT,
    `ESFU_NU_ANO`  int(4)  NOT NULL ,
    `ESFU_NU_MES`  int(2)  NOT NULL ,
    `ESFU_NU_DIA`  int(2)  NOT NULL ,
    `ESFU_IN_TIPO`  VARCHAR(100)  NOT NULL ,
    `USUA_ID` int(11) NOT NULL,
    `PROJ_ID` int(11),
    `ESFU_QT_FUNCAO` int(11) NOT NULL DEFAULT 1,
    `ESFU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ESFU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_ESFU_ESFU_ID PRIMARY KEY (ESFU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX UN_ESFU_ANO_MES_PROJ_USUA
       ON ESTATISTICA_FUNCAO(ESFU_NU_ANO, ESFU_NU_MES, ESFU_NU_DIA, ESFU_IN_TIPO, USUA_ID, PROJ_ID);

CREATE TABLE `ESTATISTICA_FUNCAO_07D` (
    `ESFU_ID` int(11) NOT NULL AUTO_INCREMENT,
    `ESFU_NU_ANO`  int(4)  NOT NULL ,
    `ESFU_NU_MES`  int(2)  NOT NULL ,
    `ESFU_NU_DIA`  int(2)  NOT NULL ,
    `ESFU_IN_TIPO`  VARCHAR(100)  NOT NULL ,
    `USUA_ID` int(11) NOT NULL,
    `PROJ_ID` int(11),
    `ESFU_QT_FUNCAO` int(11) NOT NULL DEFAULT 1,
    `ESFU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ESFU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_ESFU_ESFU_ID PRIMARY KEY (ESFU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA
       ON ESTATISTICA_FUNCAO_07D(ESFU_NU_ANO, ESFU_NU_MES, ESFU_NU_DIA, ESFU_IN_TIPO, USUA_ID, PROJ_ID);

CREATE TABLE `ESTATISTICA_FUNCAO_14D` (
    `ESFU_ID` int(11) NOT NULL AUTO_INCREMENT,
    `ESFU_NU_ANO`  int(4)  NOT NULL ,
    `ESFU_NU_MES`  int(2)  NOT NULL ,
    `ESFU_NU_DIA`  int(2)  NOT NULL ,
    `ESFU_IN_TIPO`  VARCHAR(100)  NOT NULL ,
    `USUA_ID` int(11) NOT NULL,
    `PROJ_ID` int(11),
    `ESFU_QT_FUNCAO` int(11) NOT NULL DEFAULT 1,
    `ESFU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ESFU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_ESFU_ESFU_ID PRIMARY KEY (ESFU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA
       ON ESTATISTICA_FUNCAO_14D(ESFU_NU_ANO, ESFU_NU_MES, ESFU_NU_DIA, ESFU_IN_TIPO, USUA_ID, PROJ_ID);

CREATE TABLE `ESTATISTICA_FUNCAO_30D` (
    `ESFU_ID` int(11) NOT NULL AUTO_INCREMENT,
    `ESFU_NU_ANO`  int(4)  NOT NULL ,
    `ESFU_NU_MES`  int(2)  NOT NULL ,
    `ESFU_NU_DIA`  int(2)  NOT NULL ,
    `ESFU_IN_TIPO`  VARCHAR(100)  NOT NULL ,
    `USUA_ID` int(11) NOT NULL,
    `PROJ_ID` int(11),
    `ESFU_QT_FUNCAO` int(11) NOT NULL DEFAULT 1,
    `ESFU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ESFU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_ESFU_ESFU_ID PRIMARY KEY (ESFU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA
       ON ESTATISTICA_FUNCAO_30D(ESFU_NU_ANO, ESFU_NU_MES, ESFU_NU_DIA, ESFU_IN_TIPO, USUA_ID, PROJ_ID);


/******************************************************************/
/* USUARIO_NOTIFICACAO                                             /
/******************************************************************/
/* Valores para PLAN_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
/* Valores para IN_TIPO => Tipo classificacao                      /
/* Use este flag para gerar uma saída customizada para o usuário   /
/* no dispositivo                                                  /
/* 00 = GERAL                                                      /
/******************************************************************/
CREATE TABLE USUARIO_NOTIFICACAO
(
    `USNO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da notificação',
    `USUA_ID` int(11) DEFAULT NULL COMMENT 'ID do usuário',
    `USNO_TX_NOTIFICACAO`  VARCHAR(500)  NOT NULL  COMMENT 'Notificação',
    `USNO_TX_ICON` varchar(20)  NOT NULL DEFAULT 'notify-03.png' COMMENT 'URL Icone',
    `USNO_TX_IMG` varchar(1000)  NOT NULL DEFAULT 'notify-03.png' COMMENT 'URL Imagem',
    `USNO_TX_BGCOLOR` varchar(7)  NOT NULL DEFAULT '#000000' COMMENT 'Cor de fundo',
    `USNO_IN_TIPO` varchar(2)  NOT NULL DEFAULT '00' COMMENT 'Classificador da notificação',
    `USNO_DT_PREV_APAGAR` date NOT NULL COMMENT 'Data Prevista Remoção',
    `USNO_TX_JSON` varchar(20000) DEFAULT NULL COMMENT 'Objeto JSON serializado',
    `USNO_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `USNO_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `USNO_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_USNO_USNO_ID PRIMARY KEY(USNO_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE INDEX IX_USNO_USUA_ID
       ON USUARIO_NOTIFICACAO(USUA_ID);

/******************************************************************/
/* USUARIO_TROCA_SENHA_HISTORICO                                   /
/******************************************************************/
/* Valores para UTSH_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE USUARIO_TROCA_SENHA_HISTORICO
(
    `UTSH_ID` int(11) NOT NULL AUTO_INCREMENT,
    `USUA_ID` int(11) NOT NULL,
    `UTSH_TX_TOKEN`  VARCHAR(256)  NOT NULL ,
    `UTSH_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `UTSH_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `UTSH_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_UTSH_UTSH_ID PRIMARY KEY(UTSH_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE INDEX IX_UTSH_TX_TOKEN
       ON USUARIO_TROCA_SENHA_HISTORICO(UTSH_TX_TOKEN);

CREATE INDEX IX_USUA_ID
       ON USUARIO_TROCA_SENHA_HISTORICO(USUA_ID);

/******************************************************************/
/* VERSAO                                                          /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = Ativo                                                       /
/* M = Manutenção                                                  /
/* I = Inativado (Precisa de Update)                               /
/******************************************************************/
CREATE TABLE VERSAO
(
    `VERS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da versão',
	`VERS_TX_VERSAO`  VARCHAR(50)  NOT NULL COMMENT 'Versão',
	`VERS_TX_FRONTEND`  VARCHAR(50)  NOT NULL COMMENT 'Versão Front-End',
	`VERS_TX_BACKEND`  VARCHAR(50)  NOT NULL COMMENT 'Versão Back-End',
	`VERS_TX_BD`  VARCHAR(50)  NOT NULL COMMENT 'Versão Banco Dados',
    `VERS_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `VERS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `VERS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
	CONSTRAINT PK_VERS_ID PRIMARY KEY(VERS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 100;


/******************************************************************/
/* INDICADOR_PROGRESSO                                             /
/******************************************************************/
/* Valores para INDICADOR_PROGRESSO                                /
/* A = Ativo                                                       /
/* M = Manutenção                                                  /
/* I = Inativado (Precisa de Update)                               /
/******************************************************************/
CREATE TABLE INDICADOR_PROGRESSO
(
    `INPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID indicador',
    `SESS_ID` int(11) NOT NULL COMMENT 'ID Sessão',
	`INPR_TX_ATIVIDADE`  VARCHAR(50)  NOT NULL COMMENT 'Atividade',
	`INPR_NU_PROGRESSO`  INTEGER(11)  NOT NULL DEFAULT 0 COMMENT 'Progresso',
	`INPR_NU_TOTAL`  INTEGER(11)  NOT NULL DEFAULT 0 COMMENT 'Total',
    `INPR_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `INPR_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `INPR_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
	CONSTRAINT PK_INPR_ID PRIMARY KEY(INPR_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 100;

CREATE INDEX IX_INPR_SESS_ID
       ON INDICADOR_PROGRESSO(SESS_ID);


/******************************************************************/
/* USUARIO_VERSAO                                                  /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = Ativo                                                       /
/* S = Superada                                                    /
/* I = Inativado (Precisa de Update)                               /
/******************************************************************/
CREATE TABLE USUARIO_VERSAO
(
    `USVE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Versão Usuário',
    `VERS_ID` int(11) NOT NULL COMMENT 'ID da versão',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `USVE_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `USVE_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `USVE_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
	CONSTRAINT PK_USVE_ID PRIMARY KEY(USVE_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 100;

CREATE UNIQUE INDEX UN_USVE_USUA_VERS
       ON USUARIO_VERSAO(USUA_ID, VERS_ID);



/******************************************************************/
/* VARIAVEL                                                        /
/******************************************************************/
CREATE TABLE VARIAVEL
(
    `VARI_ID` int(11) NOT NULL AUTO_INCREMENT,
	`VARI_NM_VARIAVEL`  VARCHAR(100)  NOT NULL ,
	`VARI_TX_DESCRICAO`  VARCHAR(500)  NOT NULL ,
	`VARI_TX_VALOR_CONTEUDO`  VARCHAR(500)  NOT NULL ,
    `VARI_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `VARI_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `VARI_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_VARI_VARI_ID PRIMARY KEY(VARI_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE UNIQUE INDEX UN_VARI_NM_VARIAVEL
       ON VARIAVEL(VARI_NM_VARIAVEL);


/******************************************************************/
/* MENSAGEM                                                      /
/******************************************************************/

CREATE TABLE MENSAGEM
(
    `MENS_ID` int(11) NOT NULL AUTO_INCREMENT,
    `MENS_TX_MSGCODE`  VARCHAR(8)  NOT NULL ,
	`MENS_TX_MENSAGEM`  VARCHAR(1000)  NOT NULL  ,
    `MENS_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `MENS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `MENS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_MENS_MENS_ID PRIMARY KEY(MENS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE UNIQUE INDEX UN_MENS_TX_MSGCODE
       ON MENSAGEM(MENS_TX_MSGCODE);

/******************************************************************/
/* UF                                                             */
/******************************************************************/
CREATE TABLE UF
(
	`UF_ID`  VARCHAR(2)  NOT NULL ,
	`UF_NM_ESTADO`  VARCHAR(20)  NOT NULL ,
	`UF_IN_STATUS`  VARCHAR(1)   DEFAULT 'A' NOT NULL,
    `UF_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `UF_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_UF_ID
                   PRIMARY KEY(UF_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/******************************************************************/
/* CIDADES                                                        */
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/

CREATE TABLE CIDADE
(
	`CIDA_ID`  INTEGER  NOT NULL ,
	`CIDA_NM_CIDADE`  VARCHAR(50)  NOT NULL,
	`CIDA_IN_STATUS`  VARCHAR(1)   DEFAULT 'A' NOT NULL,
    `CIDA_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `CIDA_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_CIDA_ID
                   PRIMARY KEY(CIDA_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/******************************************************************/
/* UF_CIDADE_ITEM                                                 */
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/
CREATE TABLE UF_CIDADE_ITEM
(
	`UFCI_ID`  INTEGER NOT NULL ,
	`CIDA_ID`  INTEGER  NOT NULL ,
	`UF_ID`  VARCHAR(2)  NOT NULL ,
	`UFCI_TX_DDD`  VARCHAR(2) ,
	`UFCI_NR_LATITUDE` NUMERIC(10,6) DEFAULT 0 NOT NULL,
	`UFCI_NR_LONGITUDE` NUMERIC(10,6) DEFAULT 0 NOT NULL,
	`UFCI_IN_STATUS`  VARCHAR(1)   DEFAULT 'A' NOT NULL,
    `UFCI_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `UFCI_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_UFCI_ID
                   PRIMARY KEY(UFCI_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE  UNIQUE INDEX UN_UF_CIDADE_ITEM 
        ON UF_CIDADE_ITEM(UF_ID,CIDA_ID);


/******************************************************************/
/* MARKETING DIGITAL CAMPANHA                                      /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = Ativo                                                       /
/* M = Manutenção                                                  /
/* I = Inativado (Precisa de Update)                               /
/******************************************************************/
CREATE TABLE MKD_CAMPANHA_EMAIL
(
    `MKCE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da Campanha MKD',
	`MKCE_TX_CAMPANHA`  VARCHAR(200)  NOT NULL COMMENT 'Descrição Campanha MKD',
	`MKCE_TX_TMPL_EML_RET` VARCHAR(2000) COMMENT 'Template Email Retorno',
	`MKCE_TX_URL_RECMPS_1`  VARCHAR(2000) COMMENT 'URL da Recompensa 1',
	`MKCE_TX_URL_RECMPS_2`  VARCHAR(2000) COMMENT 'URL da Recompensa 2',
	`MKCE_TX_URL_RECMPS_3`  VARCHAR(2000) COMMENT 'URL da Recompensa 3',
	`MKCE_TX_URL_UPSELL`  VARCHAR(2000) COMMENT 'URL da Upsell',
    `MKCE_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status',
    `MKCE_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `MKCE_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
	CONSTRAINT PK_MKCE_ID PRIMARY KEY(MKCE_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 100;

/******************************************************************/
/* MARKETING DIGITAL LISTA                                         /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = Ativo                                                       /
/* M = Manutenção                                                  /
/* I = Inativado (Precisa de Update)                               /
/******************************************************************/
CREATE TABLE MKD_EMAIL_LISTA
(
    `MKEL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da MKD Lista',
    `MKCE_ID` int(11) NOT NULL COMMENT 'ID da Campanha MKD',
	`MKEL_TX_NOME`  VARCHAR(200)  NOT NULL COMMENT 'Nome',
	`MKEL_TX_EMAIL`  VARCHAR(100)  NOT NULL COMMENT 'Email',
	`MKEL_TX_PRIM_NOME`  VARCHAR(100)  COMMENT 'Primeiro Nome',
	`MKEL_TX_SOBRENOME`  VARCHAR(100)  COMMENT 'Sobrenome',
	`MKEL_TX_WHATSAPP`  VARCHAR(15)  COMMENT 'Contato Whatsapp',
	`MKEL_TX_HASH`  VARCHAR(100)  NOT NULL COMMENT 'Hashcode lead',
    `MKEL_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P' COMMENT 'Status',
    `MKEL_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `MKEL_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
	CONSTRAINT PK_MKEL_ID PRIMARY KEY(MKEL_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 10;



/*================================================================*/	   
/******************************************************************/
/* TABELAS DO CARTAO FIDELIDADE DIGITAL                            /
/******************************************************************/
/*================================================================*/	   

/*************************************************************************/
/* TIPO EMPREENDIMENTO - Tipos de Empreendimentos                        */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `TIPO_EMPREENDIMENTO` (
 `TIEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do tipo de empreendimento',
 `TIEM_TX_DESCRICAO` varchar(200) NOT NULL COMMENT 'Descrição tipo de empreendimento',
 `TIEM_TX_IMG` varchar(2000) NOT NULL DEFAULT 'indefinido.png' COMMENT 'URL da imagem tipo de empreendimento',
 `TIEM_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status do tipo de empreendimento',
 `TIEM_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `TIEM_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data da última atualização',
 CONSTRAINT PK_TIEM_ID PRIMARY KEY (TIEM_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* CAMPANHA                                                        /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/

CREATE TABLE CAMPANHA
(
    `CAMP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da campanha',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `CAMP_TX_NOME`  VARCHAR(100)  NOT NULL COMMENT 'Nome da campanha',
    `CAMP_TX_EXPLICATIVO`  VARCHAR(2000)  NOT NULL  COMMENT 'Regras detalhadas da campanha',
    `CAMP_TX_AGRADECIMENTO`  VARCHAR(500)  NOT NULL DEFAULT 'Obrigado pela preferência' COMMENT 'Mensagem de agradecimento',
    `CAMP_DT_INICIO`  timestamp NOT NULL  COMMENT 'Data de início',
    `CAMP_DT_TERMINO`  timestamp NOT NULL  COMMENT 'Data de término',
    `CAMP_NU_MAX_CARTAO` int(11) NOT NULL DEFAULT 100 COMMENT 'Máximo de cartões',
    `CAMP_NU_CONT_CARTAO` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador de cartões',
    `CAMP_NU_MAX_SELOS` int(2) NOT NULL DEFAULT 10 COMMENT 'Máximo de selos por cartão',
    `CAMP_NU_MIN_DELAY` varchar(5) NOT NULL DEFAULT '00:15' COMMENT 'Tempo de delay',
    `CAMP_TX_QRCODE_ATIVO`  VARCHAR(100)  NOT NULL  COMMENT 'QR Code Ativo',
    `CAMP_ID_PROXIMO_CAQR_ID` VARCHAR(100) COMMENT 'Próximo QR Code (lista encadeada)',
    `CAMP_TX_FRASE_EFEITO`  VARCHAR(100) COMMENT 'Frase de efeito',
    `CAMP_TX_RECOMPENSA`  VARCHAR(100)  NOT NULL COMMENT 'Recompensa da campanha',
    `CAMP_TT_CARIMBOS` int(11) NOT NULL DEFAULT 0 COMMENT 'Total de carimbos',
    `CAMP_TT_CARIMBADOS` int(11) NOT NULL DEFAULT 0 COMMENT 'Total de carimbos efetivados em cartões',
    `CAMP_VL_TICKET_MEDIO` decimal(11,2) NOT NULL DEFAULT 0 COMMENT 'Valor do Ticket Médio',
    `CAMP_VL_ACM_TICKET` decimal(15,2) NOT NULL DEFAULT 0 COMMENT 'Valor acumulado do ticket médio',
    `CAMP_IN_UPD_MAX_SELOS` varchar(1)  NOT NULL DEFAULT 'S' COMMENT 'Permite atualização de Máx. Selos',
    `CAMP_TX_IMG`  VARCHAR(1500) NOT NULL  DEFAULT 'sem-imagem.jpeg' COMMENT 'URL da imagem da campanha',
    `CAMP_TX_IMG_RECOMPENSA`  VARCHAR(1500) NOT NULL DEFAULT 'sem-imagem.jpeg' COMMENT 'URL da imagem da recompensa',
    `CAMP_NU_LIKE` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador de Curtir',
    `CAMP_NU_CONT_STAR_1` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Péssima',
    `CAMP_NU_CONT_STAR_2` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ruim',
    `CAMP_NU_CONT_STAR_3` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Boa',
    `CAMP_NU_CONT_STAR_4` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ótima',
    `CAMP_NU_CONT_STAR_5` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Excelente',
    `CAMP_NU_RATING` decimal(5,1) NOT NULL DEFAULT 0 COMMENT 'Média da Avaliação',
    `CAMP_IN_CURINGA` varchar(1)  NOT NULL DEFAULT 'S' COMMENT 'Permite selo curinga',
    `CAMP_IN_CASHBACK` varchar(1)  NOT NULL DEFAULT 'N' COMMENT 'Permite participar de cashback',
    `CAMP_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'F' COMMENT 'Status',
    `CAMP_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CAMP_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CAMP_ID PRIMARY KEY(CAMP_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* CAMPANHA HISTORICO => É SEMPRE UMA CÓPIA DDL DE CAMPANHA        /
/******************************************************************/
CREATE TABLE CAMPANHA_HISTORICO
(
    `CAMP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da campanha',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `CAMP_TX_NOME`  VARCHAR(100)  NOT NULL COMMENT 'Nome da campanha',
    `CAMP_TX_EXPLICATIVO`  VARCHAR(2000)  NOT NULL  COMMENT 'Regras detalhadas da campanha',
    `CAMP_TX_AGRADECIMENTO`  VARCHAR(500)  NOT NULL DEFAULT 'Obrigado pela preferência' COMMENT 'Mensagem de agradecimento',
    `CAMP_DT_INICIO`  timestamp NOT NULL  COMMENT 'Data de início',
    `CAMP_DT_TERMINO`  timestamp NOT NULL  COMMENT 'Data de término',
    `CAMP_NU_MAX_CARTAO` int(11) NOT NULL DEFAULT 100 COMMENT 'Máximo de cartões',
    `CAMP_NU_CONT_CARTAO` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador de cartões',
    `CAMP_NU_MAX_SELOS` int(2) NOT NULL DEFAULT 10 COMMENT 'Máximo de selos por cartão',
    `CAMP_NU_MIN_DELAY` varchar(5) NOT NULL DEFAULT '00:15' COMMENT 'Tempo de delay',
    `CAMP_TX_QRCODE_ATIVO`  VARCHAR(100)  NOT NULL  COMMENT 'QR Code Ativo',
    `CAMP_ID_PROXIMO_CAQR_ID` VARCHAR(100) COMMENT 'Próximo QR Code (lista encadeada)',
    `CAMP_TX_FRASE_EFEITO`  VARCHAR(100) COMMENT 'Frase de efeito',
    `CAMP_TX_RECOMPENSA`  VARCHAR(100)  NOT NULL COMMENT 'Recompensa da campanha',
    `CAMP_TT_CARIMBOS` int(11) NOT NULL DEFAULT 0 COMMENT 'Total de carimbos',
    `CAMP_TT_CARIMBADOS` int(11) NOT NULL DEFAULT 0 COMMENT 'Total de carimbos efetivados em cartões',
    `CAMP_VL_TICKET_MEDIO` decimal(11,2) NOT NULL DEFAULT 0 COMMENT 'Valor do Ticket Médio',
    `CAMP_VL_ACM_TICKET` decimal(15,2) NOT NULL DEFAULT 0 COMMENT 'Valor acumulado do ticket médio',
    `CAMP_IN_UPD_MAX_SELOS` varchar(1)  NOT NULL DEFAULT 'S' COMMENT 'Permite atualização de Máx. Selos',
    `CAMP_TX_IMG`  VARCHAR(1500) NOT NULL  DEFAULT 'sem-imagem.jpeg' COMMENT 'URL da imagem da campanha',
    `CAMP_TX_IMG_RECOMPENSA`  VARCHAR(1500) NOT NULL DEFAULT 'sem-imagem.jpeg' COMMENT 'URL da imagem da recompensa',
    `CAMP_NU_LIKE` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador de Curtir',
    `CAMP_NU_CONT_STAR_1` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Péssima',
    `CAMP_NU_CONT_STAR_2` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ruim',
    `CAMP_NU_CONT_STAR_3` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Boa',
    `CAMP_NU_CONT_STAR_4` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ótima',
    `CAMP_NU_CONT_STAR_5` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Excelente',
    `CAMP_NU_RATING` decimal(5,1) NOT NULL DEFAULT 0 COMMENT 'Média da Avaliação',
    `CAMP_IN_CURINGA` varchar(1)  NOT NULL DEFAULT 'S' COMMENT 'Permite selo curinga',
    `CAMP_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'F' COMMENT 'Status',
    `CAMP_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CAMP_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CAMP_ID PRIMARY KEY(CAMP_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

/******************************************************************/
/* QRCODES CURINGAS                                                /
/******************************************************************/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* U = Utilizado                                                   /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE QRCODES_CURINGA
(
    `QRCU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID QR Code Curinga',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `CAMP_ID` int(11) DEFAULT NULL COMMENT 'ID da campanha',
    `CART_ID` int(11) DEFAULT NULL COMMENT 'ID do cartão',
    `USUA_AUTORIZACAO_ID` int(11) DEFAULT NULL COMMENT 'ID do usuário que cedeu o selo',
    `QRCU_TX_QRCODE`  VARCHAR(100) NOT NULL  COMMENT 'QR Code Curinga',
    `QRCU_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A' COMMENT 'Status do carimbo curinga',
    `QRCU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de Cadastro',
    `QRCU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de Atualização',
  CONSTRAINT PK_QRCU_ID PRIMARY KEY(QRCU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UN_QRCU_TX_QRCODE
       ON QRCODES_CURINGA(QRCU_TX_QRCODE);

/******************************************************************/
/* FILA QRCODES PENDENTES PRODUCAO                                 /
/******************************************************************/
/* Valores para USUA_IN_STATUS                                     /
/* P = Pendente                                                    /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE FILA_QRCODES_PNDNT_PRD
(
    `FQPP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Fila QR Pendente',
    `CAMP_ID` int(11) DEFAULT NULL COMMENT 'ID da campanha',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `FQPP_NU_QTDE_QRC` int(5) DEFAULT 0 COMMENT 'Qtde QR Code Produzir',
    `FQPP_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P' COMMENT 'Status do carimbo curinga',
    `FQPP_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de Cadastro',
    `FQPP_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de Atualização',
  CONSTRAINT PK_FQPP_ID PRIMARY KEY(FQPP_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_FQPP_CAMP_USUA
       ON FILA_QRCODES_PNDNT_PRD(CAMP_ID, USUA_ID);


/******************************************************************/
/* QRCODES DA CAMPANHA (CARIMBOS VALIDOS)                          /
/******************************************************************/
/* Valores para USUA_IN_STATUS                                     /
/* A = Ativo                                                       /
/* U = Utilizado                                                   /
/* I = Inativado                                                   /
/******************************************************************/
CREATE TABLE CAMPANHA_QRCODES
(
    `CAQR_ID` VARCHAR(100) NOT NULL,
    `CAQR_ID_PARENT` VARCHAR(100),
    `CAMP_ID` int(11) NOT NULL,
    `CAQR_TX_QRCODE`  VARCHAR(100)  NOT NULL  ,
    `CAQR_NU_ORDER`  int(10)  NOT NULL DEFAULT 0,
    `CAQR_TX_TICKET`  VARCHAR(100)  NOT NULL  ,
    `USUA_ID_GERADOR`  int(11) NOT NULL DEFAULT 1,
    `CAQR_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'A',
    `CAQR_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `CAQR_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_CAQR_ID PRIMARY KEY(CAQR_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UN_CAMP_ID_CAQR_TX_QRCODE
       ON CAMPANHA_QRCODES(CAMP_ID, CAQR_TX_QRCODE);

CREATE UNIQUE INDEX UN_CAQR_ID_PARENT
        ON CAMPANHA_QRCODES(CAQR_ID_PARENT);

CREATE INDEX UN_CAQR_ORDER
        ON CAMPANHA_QRCODES(CAMP_ID,CAQR_NU_ORDER);

/******************************************************************/
/* CFDI - CARTÃO FIDELIDADE DIGITAL - controle dos carimbos       */
/******************************************************************/
/* Valores para CFDI_IN_MODO                                       /
/* APLICATIVO = Registro do carimbo foi feito pelo App por QRCode  /
/* TICKET = Registro do carimbo feito pelo App via Código (Ticket) /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/******************************************************************/
CREATE TABLE `CFDI` (
 `CFDI_ID` int(11) NOT NULL AUTO_INCREMENT,
 `CAMP_ID`  int(11) NOT NULL,
 `USUA_ID`  int(11) NOT NULL,
 `CFDI_TX_QRCODE_REGIST`  VARCHAR(100)  NOT NULL  ,
 `CFDI_IN_MODO` varchar(20)  NOT NULL,
 `CFDI_VL_TICKET_MEDIO` decimal(11,2) NOT NULL DEFAULT 0,
 `USUA_ID_GERADOR`  int(11) DEFAULT 0,
 `CFDI_IN_STATUS` varchar(1) NOT NULL DEFAULT 'P',
 `CFDI_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `CFDI_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT PK_CFDI_ID PRIMARY KEY (CFDI_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UIX_CFDI_TX_QRCODE_REGIST
        ON CFDI(CFDI_TX_QRCODE_REGIST);

/******************************************************************/
/* CAMPANHA SORTEIO                                                /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/* P = PENDENTE                                                    /
/******************************************************************/

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

/******************************************************************/
/* CAMPANHA SORTEIO FILA CRIAÇÃO                                   /
/******************************************************************/
/* Valores para _IN_STATUS                                         /
/* A = ATIVO                                                       /
/* I = INATIVO                                                     /
/* P = PENDENTE                                                    /
/******************************************************************/

CREATE TABLE CAMPANHA_SORTEIO_FILA_CRIACAO
(
    `CSFC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da campanha sorteio fila criação',
    `CASO_ID` int(11) NOT NULL COMMENT 'ID da campanha sorteio',
    `CSFC_QT_LOTE`  int(5) NOT NULL DEFAULT 0 COMMENT 'Qtde lotes de tickets',
    `CSFC_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'P' COMMENT 'Status',
    `CSFC_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `CSFC_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
  CONSTRAINT PK_CSFC_ID PRIMARY KEY(CSFC_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CSFC_CASO_ID
        ON CAMPANHA_SORTEIO_FILA_CRIACAO(CASO_ID);
        
/******************************************************************/
/* CARTAO - TABELA DE AGREGACAO DO CARTAO                         */
/******************************************************************/
/* Valores para CART_IN_STATUS                                     /
/* A = ATIVO                                                       /
/* 0 = COMPLETO                                                    /
/* 1 = VALIDADO PARA RESGATE                                       /
/* 2 = RECOMPENSA ENTREGE PELO PATROCINADOR                        /
/* 3 = RECOMPENSA RECEBIDA PELO USUARIO                            /
/* 4 = AGUARDANDO PELO ROBO DE ARQUIVAMENTO                        /
/******************************************************************/
CREATE TABLE `CARTAO` (
 `CART_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do cartão',
 `CAMP_ID`  int(11) NOT NULL COMMENT 'Código da campanha',
 `USUA_ID`  int(11) NOT NULL COMMENT 'Código do usuário',
 `CART_TX_HASH_RESGATE` varchar(100) NOT NULL COMMENT 'Hash para resgate (automático)',
 `CART_NU_CONTADOR`  int(11)  NOT NULL DEFAULT 0 COMMENT 'Contador de selos',
 `CART_IN_FAVORITO` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Sinalizador Cartão Favorito',
 `CART_TX_CFDI_CARIMBOS` varchar(2000) COMMENT 'Sequência de carimbos',
 `QRCU_ID` int(11) DEFAULT NULL COMMENT 'Carimbo Curinga',
 `CART_DT_COMPLETOU` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Data que completou o cartão',
 `CART_DT_VALIDOU` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Data de Validação do cartão',
 `CART_DT_ENTREGOU_REC` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Data de Entrega da Recompensa',
 `CART_DT_CONFIRM_RECEBEU` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Data de Confirmação de Recebimento Recompensa',
 `CART_DT_RATING` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Data da Avaliação',
 `CART_IN_LIKE` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Like do cartão',
 `CART_IN_RATING` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Avaliação do cliente',
 `CART_TX_COMENT` varchar(1000) COMMENT 'Comentário do cartão',
 `CART_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status do cartão',
 `CART_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CART_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CART_ID PRIMARY KEY (CART_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CARTAO
        ON CARTAO(CAMP_ID,USUA_ID);

CREATE INDEX UIX_HASH_RESGATE
        ON CARTAO(CART_TX_HASH_RESGATE);

/********************************************************************/
/* CARTAO HISTORICO - É UMA CÓPIA DDL DA TABELA CARTÃO              */
/********************************************************************/
CREATE TABLE `CARTAO_HISTORICO` (
 `CART_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do cartão',
 `CAMP_ID`  int(11) NOT NULL COMMENT 'Código da campanha',
 `USUA_ID`  int(11) NOT NULL COMMENT 'Código do usuário',
 `CART_TX_HASH_RESGATE` varchar(100) NOT NULL COMMENT 'Hash para resgate (automático)',
 `CART_NU_CONTADOR`  int(11)  NOT NULL DEFAULT 0 COMMENT 'Contador de selos',
 `CART_IN_FAVORITO` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Sinalizador Cartão Favorito',
 `CART_TX_CFDI_CARIMBOS` varchar(2000) COMMENT 'Sequência de carimbos',
 `QRCU_ID` int(11) DEFAULT NULL COMMENT 'Carimbo Curinga',
 `CART_DT_COMPLETOU` timestamp COMMENT 'Data que completou o cartão',
 `CART_DT_VALIDOU` timestamp COMMENT 'Data de Validação do cartão',
 `CART_DT_ENTREGOU_REC` timestamp COMMENT 'Data de Entrega da Recompensa',
 `CART_DT_CONFIRM_RECEBEU` timestamp COMMENT 'Data de Confirmação de Recebimento Recompensa',
 `CART_DT_RATING` timestamp COMMENT 'Data da Avaliação',
 `CART_IN_LIKE` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Like do cartão',
 `CART_IN_RATING` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Avaliação do cliente',
 `CART_TX_COMENT` varchar(1000) COMMENT 'Comentário do cartão',
 `CART_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status do cartão',
 `CART_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CART_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CART_ID PRIMARY KEY (CART_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CARTAO_HISTORICO
        ON CARTAO(CAMP_ID,USUA_ID);

CREATE INDEX UIX_HASH_RESGATE_HIST
        ON CARTAO(CART_TX_HASH_RESGATE);

/******************************************************************/
/* CARTAO_PEDIDO - TABELA DE PEDIDOS DE ACRESCIMO DE CARTÕES      */
/******************************************************************/
/* Valores para CART_IN_STATUS                                     /
/* A = ATIVO                                                       /
/* P = PENDENTE                                                    /
/* V = APROVADO                                                    /
/* I = INATIVO                                                     /
/******************************************************************/
/* Valores para cape_IN_TIPO                                       /
/* PLA = Plano Comum (de acordo com tabela de preços)              /
/* PUB = Planos de Publicidade/Promoção                            /
/* CRT = Plano de Venda de Adição de Cartões+Carimbos              /
/* CMP = Plano de Venda de Adição de campanhas                     /
/******************************************************************/
CREATE TABLE `CARTAO_PEDIDO` (
 `CAPE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do cartão pedido',
 `CAMP_ID` int(11) NOT NULL COMMENT 'ID da campanha',
 `CAPE_TX_PEDIDO` varchar(500) NOT NULL COMMENT 'Descrição do pedido',
 `CAPE_TX_HASH` varchar(100) NOT NULL COMMENT 'Hash de transação',
 `CAPE_NU_QTDE`  int(5)  NOT NULL DEFAULT 0 COMMENT 'Quantidade',
 `CAPE_NU_SELOS` int(2) NOT NULL DEFAULT 0 COMMENT 'Número de Selos',
 `CAPE_VL_PEDIDO` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor do pedido',
 `CAPE_DT_AUTORIZACAO` timestamp COMMENT 'Data de Autorização Gateway',
 `CAPE_DT_PGTO` timestamp COMMENT 'Data do pagamento',
 `CAPE_VL_PGTO` DECIMAL(10,2) DEFAULT 0 COMMENT 'Valor Efetivo Pago',
 `CAPE_TX_HASH_GATEWAY` varchar(100) COMMENT 'Hash de transação do Gateway',
 `CAPE_IN_TIPO` varchar(3) NOT NULL DEFAULT 'CRT' COMMENT 'Tipo do Pedido',
 `CAPE_IN_STATUS` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'Status do cartão',
 `CAPE_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CAPE_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CAPE_ID PRIMARY KEY (CAPE_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CAPE_CAMP
        ON CARTAO_PEDIDO(CAMP_ID);

CREATE INDEX UIX_HASH
        ON CARTAO_PEDIDO(CAPE_TX_HASH);

/*************************************************************************/
/* USUARIO_PUBLICIDADE - PUBLICIDADES REALIZADAS PELO USUARIO            */
/*************************************************************************/
/* Valores para IN_STATUS                                                 /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
/* Valores para IN_MODELO                                                 /
/* 0 = Primeiro modelo                                                    /
/*************************************************************************/
CREATE TABLE `USUARIO_PUBLICIDADE` (
 `USPU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuário x Publicidade',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `USPU_TX_TITULO` varchar(500) NOT NULL COMMENT 'Título da publicidade',
 `USPU_TX_DESCRICAO` varchar(2000) NOT NULL COMMENT 'Descrição geral',
 `USPU_DT_INICIO` timestamp COMMENT 'Data de início',
 `USPU_DT_TERMINO` timestamp COMMENT 'Data de término',
 `USPU_VL_NORMAL` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor do produto/serviço',
 `USPU_VL_PROMO` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor promocional produto/serviço',
 `USPU_TX_OBS` varchar(2000) NOT NULL COMMENT 'Observação',
 `USPU_DT_APAGAR` timestamp COMMENT 'Data para apagar',
 `USPU_IN_MODELO` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Identificador de Modelo',
 `USPU_TX_URL` varchar(2000) NOT NULL DEFAULT 'assets/images/sem-imagem.jpeg' COMMENT 'URL da Imagem', 
 `USPU_IN_STATUS` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'Status',
 `USPU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `USPU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_USPU_ID PRIMARY KEY (USPU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_USUA_ID
        ON USUARIO(USUA_ID);

/******************************************************************/
/* USUARIO_AUTORIZADOR                                             /
/******************************************************************/
/* Valores para PLAN_IN_STATUS                                     /
/* A = Ativo                                                       /
/* I = Inativado                                                   /
/* C = Desabilitado                                                /
/******************************************************************/
/* Valores para IN_TIPO => Tipo de autorização                     /
/* T = Temporaria  (default)                                       /
/* P = Permanente                                                  /
/******************************************************************/
/* Valores para IN_AUTORIZACAO => Qual autorização                 /
/* 00 = Autorizado pegar carimbo livre                             /
/******************************************************************/
CREATE TABLE USUARIO_AUTORIZADOR
(
    `USAU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do usuário autorizado',
    `USUA_ID` int(11) DEFAULT NULL COMMENT 'ID do usuário',
    `USUA_ID_AUTORIZADOR` int(11) DEFAULT NULL COMMENT 'ID do usuário autorizador',
    `CAMP_ID` int(11) DEFAULT NULL COMMENT 'ID da campanha',
    `USAU_IN_TIPO`  VARCHAR(1)  NOT NULL  DEFAULT 'T' COMMENT 'Tipo de autorização',
    `USAU_IN_AUTORIZACAO`  VARCHAR(2)  NOT NULL  DEFAULT '00' COMMENT 'Qual autorização',
    `USAU_DT_INICIO` timestamp COMMENT 'Data Início',
    `USAU_DT_TERMINO` timestamp COMMENT 'Data Término',
    `USAU_IN_STATUS` varchar(1)  NOT NULL DEFAULT 'C' COMMENT 'Status',
    `USAU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `USAU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_USAU_ID PRIMARY KEY(USAU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE INDEX IX_USAU_USUA_ID
       ON USUARIO_AUTORIZADOR(USUA_ID);

/*************************************************************************/
/* USUARIO_AVALIACAO - AVALIACAO DO PATROCINADOR DE CAMPANHAS            */
/*************************************************************************/
/* Valores para IN_STATUS                                                 /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `USUARIO_AVALIACAO` (
    `USAV_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuário x Avaliação',
    `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
    `USAV_NU_CONT_STAR_1` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Péssima',
    `USAV_NU_CONT_STAR_2` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ruim',
    `USAV_NU_CONT_STAR_3` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Boa',
    `USAV_NU_CONT_STAR_4` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ótima',
    `USAV_NU_CONT_STAR_5` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Excelente',
    `USAV_NU_RATING` decimal(5,1) NOT NULL DEFAULT 0 COMMENT 'Média da Avaliação',
    `USAV_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
    `USAV_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
    `USAV_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
    CONSTRAINT PK_USAV_ID PRIMARY KEY (USAV_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_USAV_USUA_ID
        ON USUARIO(USUA_ID);

/*************************************************************************/
/* USUARIO_CASHBACK - PROGRAMA DE CASHBACK DO USUARIO                    */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `USUARIO_CASHBACK` (
 `USCA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuario x Cashback',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `USCA_VL_RESGATE` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Resgatar a partir de',
 `USCA_VL_PERC_CASHBACK` DECIMAL(6,2) NOT NULL DEFAULT 0 COMMENT 'Percentual',
 `USCA_TX_OBS` varchar(2000) DEFAULT NULL COMMENT 'Observação',
 `USCA_NU_CONT_STAR_1` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Péssima',
 `USCA_NU_CONT_STAR_2` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ruim',
 `USCA_NU_CONT_STAR_3` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Boa',
 `USCA_NU_CONT_STAR_4` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Ótima',
 `USCA_NU_CONT_STAR_5` int(11) NOT NULL DEFAULT 0 COMMENT 'Contador Avaliação Excelente',
 `USCA_NU_RATING` decimal(5,1) NOT NULL DEFAULT 0 COMMENT 'Média da Avaliação',
 `USCA_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `USCA_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `USCA_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_USCA_ID PRIMARY KEY (USCA_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_USCA_USUA_ID
        ON USUARIO_CASHBACK(USUA_ID);

/*************************************************************************/
/* CAMPANHA_TOPDEZ                                                       */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `CAMPANHA_TOPDEZ` (
 `CATO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Campanha Top Dez',
 `CAMP_ID` int(11) NULL COMMENT 'ID da campanha',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `CATO_QT_PARTICIPACAO` int(6) NOT NULL DEFAULT 0 COMMENT 'Qtde participação',
 `CATO_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `CATO_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CATO_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CATO_ID PRIMARY KEY (CATO_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE UNIQUE INDEX UIX_CATO_CAMP_USUA
        ON CAMPANHA_TOPDEZ(CAMP_ID,USUA_ID);

CREATE INDEX IX_CATO_USUA
        ON CAMPANHA_TOPDEZ(USUA_ID);


/*************************************************************************/
/* CAMPANHA_CASHBACK - PROGRAMA DE CASHBACK                              */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `CAMPANHA_CASHBACK` (
 `CACA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Campanha x Cashback',
 `USCA_ID` int(11) NOT NULL COMMENT 'ID Usuario x Cashback',
 `CAMP_ID` int(11) NULL COMMENT 'ID da campanha',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `CACA_VL_PERC_CASHBACK` DECIMAL(6,2) NOT NULL DEFAULT 0 COMMENT 'Percentual',
 `CACA_DT_TERMINO` timestamp COMMENT 'Data de término',
 `CACA_TX_OBS` varchar(2000) DEFAULT NULL COMMENT 'Observação',
 `CACA_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `CACA_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CACA_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CACA_ID PRIMARY KEY (CACA_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CACA_CAMP_ID
        ON CAMPANHA_CASHBACK(CAMP_ID);

/*************************************************************************/
/* CAMPANHA_CASHBACK_CC - PROGRAMA DE CASHBACK CONTA CORRENTE            */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
/* Valores para _IN_TIPO                                                  /
/* C=CREDITO | D=DEBITO | S=SALDO                                        */
/*************************************************************************/
CREATE TABLE `CAMPANHA_CASHBACK_CC` (
 `CACC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da Conta Corrente Cashback',
 `CACA_ID` int(11) COMMENT 'ID da campanha x cashback',
 `CAMP_ID` int(11) COMMENT 'ID da campanha',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do usuário',
 `USUA_ID_DONO` int(11) NOT NULL COMMENT 'ID do usuário dono da campanha',
 `CFDI_ID` int(11) COMMENT 'ID do carimbo efetuado no cartão',
 `CACC_TX_DESCRICAO` varchar(500) NOT NULL COMMENT 'Cópia da descrição',
 `CACC_VL_MIN` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor para permitir cashback',
 `CACC_VL_PERC_CASHBACK` DECIMAL(6,2) NOT NULL DEFAULT 0 COMMENT 'Cópia do perc. cashback',
 `CACC_VL_CONSUMO` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor do consumo',
 `CACC_VL_RECOMPENSA` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Valor da recompensa',
 `CACC_IN_TIPO` varchar(1) NOT NULL DEFAULT 'C' COMMENT 'Tipo do movimento', 
 `CACC_TX_NFE` varchar(2000) COMMENT 'NF Eletrônica',
 `CACC_TX_NFE_HASH` varchar(2000) COMMENT 'Hash NFE',
 `CACC_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `CACC_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `CACC_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_CACC_ID PRIMARY KEY (CACC_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_CACC_USUA_ID  ON CAMPANHA_CASHBACK_CC(USUA_ID);
CREATE INDEX IX_CACC_USUA_ID_DONO  ON CAMPANHA_CASHBACK_CC(USUA_ID_DONO);
CREATE INDEX IX_CACC_01  ON CAMPANHA_CASHBACK_CC(USUA_ID, USUA_ID_DONO);


/*************************************************************************/
/* USUARIO x TIPO EMPREENDIMENTO                                         */
/*************************************************************************/
/* Valores para _IN_STATUS                                                /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `USUARIO_TIPO_EMPREENDIMENTO` (
 `USTE_ID` int(11) NOT NULL AUTO_INCREMENT,
 `USUA_ID` int(11) NOT NULL,
 `TIEM_ID` int(11) NOT NULL,
 `USTE_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A',
 `USTE_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `USTE_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT PK_USTE_ID PRIMARY KEY (USTE_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_USTE_USUA_ID
        ON USUARIO_TIPO_EMPREENDIMENTO(USUA_ID);

CREATE INDEX IX_USTE_TIEM_ID
        ON USUARIO_TIPO_EMPREENDIMENTO(TIEM_ID);

/*************************************************************************/
/* FILA_PUBLICIDADE - FILA DE PUBLICIDADES REALIZADAS PELO USUARIO       */
/*************************************************************************/
/* Valores para IN_STATUS                                                 /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `FILA_PUBLICIDADE` (
 `FIPU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Fila Publicidade',
 `USPU_ID` int(11) NOT NULL COMMENT 'ID Usuário x Publicidade',
 `USUA_ID` int(11) NOT NULL COMMENT 'ID do Usuário',
 `JOBS_ID` int(11) NOT NULL COMMENT 'ID do Job',
 `FIPU_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `FIPU_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `FIPU_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_FIPU_ID PRIMARY KEY (FIPU_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

CREATE INDEX IX_FIPO_USUA_ID
        ON USUARIO(USUA_ID);

CREATE INDEX IX_FIPO_USPU_ID
        ON USUARIO_PUBLICIDADE(USPU_ID);

/*************************************************************************/
/* JOBS                                                                  */
/*************************************************************************/
/* Valores para IN_STATUS                                                 /
/* A = ATIVO                                                              /
/* I = INATIVO                                                            /
/*************************************************************************/
CREATE TABLE `JOBS` (
 `JOBS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Job',
 `JOBS_TX_DESCRICAO` varchar(500) NOT NULL COMMENT 'Descrição',
 `JOBS_IN_STATUS` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'Status',
 `JOBS_DT_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro',
 `JOBS_DT_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de atualização',
 CONSTRAINT PK_JOBS_ID PRIMARY KEY (JOBS_ID)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT = 1000;

-- CONSTRAINTS FOREIGN KEY

-- PLANOS X USUARIO X PLANO_USUARIO
ALTER TABLE PLANO_USUARIO
    ADD CONSTRAINT FK_PLUS_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE PLANO_USUARIO
    ADD CONSTRAINT FK_PLUS_PLAN
    FOREIGN KEY (PLAN_ID)
    REFERENCES PLANOS(PLAN_ID);    

-- PLANO_USUARIO_FATURA X PLANO_USUARIO
ALTER TABLE PLANO_USUARIO_FATURA
    ADD CONSTRAINT FK_PLUF_PLUS
    FOREIGN KEY (PLUS_ID)
    REFERENCES PLANO_USUARIO(PLUS_ID) ON DELETE CASCADE;

-- USUARIO_TROCA_SENHA_HISTORICO x USUARIO
ALTER TABLE USUARIO_TROCA_SENHA_HISTORICO
    ADD CONSTRAINT FK_UTSH_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

-- CAMPANHA X USUARIO
ALTER TABLE CAMPANHA
    ADD CONSTRAINT FK_CAMP_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

-- CAMPANHA_QRCODES (CARIMBOS VALIDOS) X CAMPANHA 
ALTER TABLE CAMPANHA_QRCODES
    ADD CONSTRAINT FK_CAQR_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID);

ALTER TABLE CAMPANHA_QRCODES
    ADD CONSTRAINT FK_CAQR_USUA
    FOREIGN KEY (USUA_ID_GERADOR)
    REFERENCES USUARIO(USUA_ID);

-- CAMPANHA HISTORICO X CAMPANHA
ALTER TABLE CAMPANHA_HISTORICO
    ADD CONSTRAINT FK_CAHI_CAMP
    FOREIGN KEY (CAMP_ID)    
    REFERENCES CAMPANHA(CAMP_ID);

-- CFDI X USUARIO X CAMPANHA
ALTER TABLE CFDI
    ADD CONSTRAINT FK_CFDI_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

ALTER TABLE CFDI
    ADD CONSTRAINT FK_CFDI_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID);

ALTER TABLE CFDI
    ADD CONSTRAINT FK_CFDI_USUA_GERADOR
    FOREIGN KEY (USUA_ID_GERADOR)
    REFERENCES USUARIO(USUA_ID);

-- USUARIO X USUARIO_COMPLEMENTO
ALTER TABLE USUARIO_COMPLEMENTO
    ADD CONSTRAINT FK_USCO_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

-- UF x CIDADES	
ALTER TABLE UF_CIDADE_ITEM
	ADD CONSTRAINT  FK_CIDADE_UF_CIDADE_ITEM 
        FOREIGN KEY (CIDA_ID) 
        REFERENCES CIDADE(CIDA_ID) ON DELETE CASCADE;

ALTER TABLE UF_CIDADE_ITEM
	ADD CONSTRAINT  FK_UF_UF_CIDADE_ITEM 
        FOREIGN KEY (UF_ID) 
        REFERENCES UF(UF_ID) ON DELETE CASCADE;
	
-- USUARIO_PUBLICIDADE X USUARIO
ALTER TABLE USUARIO_PUBLICIDADE
    ADD CONSTRAINT FK_USPU_CAMP
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

/* USUARIO X TIPO_EMPREENDIMENTO */
ALTER TABLE USUARIO_TIPO_EMPREENDIMENTO
    ADD CONSTRAINT FK_USTE_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

ALTER TABLE USUARIO_TIPO_EMPREENDIMENTO
    ADD CONSTRAINT FK_USTE_TIEM
    FOREIGN KEY (TIEM_ID)
    REFERENCES TIPO_EMPREENDIMENTO(TIEM_ID);

/* USUARIO x CASHBACK */
ALTER TABLE USUARIO_CASHBACK
    ADD CONSTRAINT FK_USCA_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

/* CASHBACK x CAMPANHA */
ALTER TABLE CAMPANHA_CASHBACK
    ADD CONSTRAINT FK_CACA_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID);

ALTER TABLE CAMPANHA_CASHBACK
    ADD CONSTRAINT FK_CACA_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

ALTER TABLE CAMPANHA_CASHBACK
    ADD CONSTRAINT FK_CACA_USCA
    FOREIGN KEY (USCA_ID)
    REFERENCES USUARIO_CASHBACK(USCA_ID);

/* CASHBACK_CC */

ALTER TABLE CAMPANHA_CASHBACK_CC
    ADD CONSTRAINT FK_CACC_CACA
    FOREIGN KEY (CACA_ID)
    REFERENCES CAMPANHA_CASHBACK(CACA_ID);

ALTER TABLE CAMPANHA_CASHBACK_CC
    ADD CONSTRAINT FK_CACC_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID);

ALTER TABLE CAMPANHA_CASHBACK_CC
    ADD CONSTRAINT FK_CACC_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID);

ALTER TABLE CAMPANHA_CASHBACK_CC
    ADD CONSTRAINT FK_CACC_USUA_DONO
    FOREIGN KEY (USUA_ID_DONO)
    REFERENCES USUARIO(USUA_ID);

ALTER TABLE CAMPANHA_CASHBACK_CC
    ADD CONSTRAINT FK_CACC_CFDI
    FOREIGN KEY (CFDI_ID)
    REFERENCES CFDI(CFDI_ID);

/* QRCODES CURINGAS x USUARIO X CAMPANHA */
ALTER TABLE QRCODES_CURINGA
    ADD CONSTRAINT FK_QRCU_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;

ALTER TABLE QRCODES_CURINGA
    ADD CONSTRAINT FK_QRCU_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE QRCODES_CURINGA
    ADD CONSTRAINT FK_QRCU_CART
    FOREIGN KEY (CART_ID)
    REFERENCES CARTAO(CART_ID) ON DELETE CASCADE;

ALTER TABLE QRCODES_CURINGA
    ADD CONSTRAINT FK_QRCU_USUA2
    FOREIGN KEY (USUA_AUTORIZACAO_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

/* CARTAO x QRCODE CURINGA*/
ALTER TABLE CARTAO
    ADD CONSTRAINT FK_CART_QRCU
    FOREIGN KEY (QRCU_ID)
    REFERENCES QRCODES_CURINGA(QRCU_ID) ON DELETE CASCADE;

/* USUARIO x NOTIFICACAO */
ALTER TABLE USUARIO_NOTIFICACAO
    ADD CONSTRAINT FK_USNO_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

/* USUARIO_AVALIACAO - AVALIACAO DO PATROCINADOR DE CAMPANHAS */
ALTER TABLE USUARIO_AVALIACAO
    ADD CONSTRAINT FK_USAV_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

/* USUARIO_AUTORIZADOR x USUARIO */
ALTER TABLE USUARIO_AUTORIZADOR
    ADD CONSTRAINT FK_USAU_USUA_ID
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE USUARIO_AUTORIZADOR
    ADD CONSTRAINT FK_USAU_USUA_ID_AUTORIZADOR
    FOREIGN KEY (USUA_ID_AUTORIZADOR)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE USUARIO_AUTORIZADOR
    ADD CONSTRAINT FK_USAU_CAMP_ID
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;

/* CAMPANHA x CARTAO_PEDIDO */
ALTER TABLE CARTAO_PEDIDO
    ADD CONSTRAINT FK_CAMP_CAPE
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID);

/* CAMPANHA x CAMPANHA_TOPDEZ */
ALTER TABLE CAMPANHA_TOPDEZ
    ADD CONSTRAINT FK_CATO_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;

ALTER TABLE CAMPANHA_TOPDEZ
    ADD CONSTRAINT FK_CATO_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

/* FILA_PUBLICIDADE */
ALTER TABLE FILA_PUBLICIDADE
    ADD CONSTRAINT FK_FIPU_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE FILA_PUBLICIDADE
    ADD CONSTRAINT FK_FIPU_USPU
    FOREIGN KEY (USPU_ID)
    REFERENCES USUARIO_PUBLICIDADE(USPU_ID) ON DELETE CASCADE;

ALTER TABLE FILA_PUBLICIDADE
    ADD CONSTRAINT FK_FIPU_JOBS
    FOREIGN KEY (JOBS_ID)
    REFERENCES JOBS(JOBS_ID) ON DELETE CASCADE;

/* USUARIO_VERSAO */
ALTER TABLE USUARIO_VERSAO
    ADD CONSTRAINT FK_USVE_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE USUARIO_VERSAO
    ADD CONSTRAINT FK_USVE_VERS
    FOREIGN KEY (VERS_ID)    
    REFERENCES VERSAO(VERS_ID) ON DELETE CASCADE;

/* INDICADOR_PROGRESSO */    
ALTER TABLE INDICADOR_PROGRESSO
    ADD CONSTRAINT FK_INPR_SESS
    FOREIGN KEY (SESS_ID)
    REFERENCES SESSAO(SESS_ID) ON DELETE CASCADE;

/* FILA QRCODES PENDENTES PRODUCAO */
ALTER TABLE FILA_QRCODES_PNDNT_PRD  
    ADD CONSTRAINT FK_FQPP_USUA
    FOREIGN KEY (USUA_ID)
    REFERENCES USUARIO(USUA_ID) ON DELETE CASCADE;

ALTER TABLE FILA_QRCODES_PNDNT_PRD  
    ADD CONSTRAINT FK_FQPP_CAMP
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;

/* MKD LISTA x MKD CAMPANHA */
ALTER TABLE MKD_EMAIL_LISTA  
    ADD CONSTRAINT FK_MKEL_MKCE
    FOREIGN KEY (MKCE_ID)
    REFERENCES MKD_CAMPANHA_EMAIL(MKCE_ID);

/* CAMPANHA X CAMPANHA SORTEIO */
ALTER TABLE CAMPANHA_SORTEIO
    ADD CONSTRAINT FK_CAMP_CASO
    FOREIGN KEY (CAMP_ID)
    REFERENCES CAMPANHA(CAMP_ID) ON DELETE CASCADE;

/* CAMPANHA SORTEIO X CAMPANHA SORTEIO FILA CRIACAO */
ALTER TABLE CAMPANHA_SORTEIO_FILA_CRIACAO
    ADD CONSTRAINT FK_CASO_CSFC
    FOREIGN KEY (CASO_ID) 
    REFERENCES CAMPANHA_SORTEIO(CASO_ID) ON DELETE CASCADE;   



/* AJUSTES DE CAMPOS TIMESTAMP */
ALTER TABLE `CAMPANHA` CHANGE `CAMP_DT_INICIO` `CAMP_DT_INICIO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de início';

