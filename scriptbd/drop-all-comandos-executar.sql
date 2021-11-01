
/* desabilita todas FKs para efetivar o DROP TABLE */
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE VW_SEGLOG;

ALTER TABLE CAMPANHA_QRCODES DROP INDEX UN_CAMP_ID_CAQR_TX_QRCODE;
ALTER TABLE CAMPANHA_QRCODES DROP INDEX UN_CAMP_ID_CAQR_TX_QRCODE;
ALTER TABLE CAMPANHA_QRCODES DROP INDEX UN_CAQR_TX_QRCODE;
ALTER TABLE CAMPANHA_QRCODES DROP INDEX UN_CAQR_ID_PARENT;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO DROP INDEX UN_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_07D DROP INDEX UN_07D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_14D DROP INDEX UN_14D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE ESTATISTICA_FUNCAO_30D DROP INDEX UN_30D_ESFU_ANO_MES_PROJ_USUA;
ALTER TABLE MENSAGEM DROP INDEX UN_MENS_TX_MSGCODE;
ALTER TABLE QRCODES_CURINGA DROP INDEX UN_QRCU_TX_QRCODE;
ALTER TABLE SESSAO DROP INDEX UN_SESS_TX_HASH;
ALTER TABLE UF_CIDADE_ITEM DROP INDEX UN_UF_CIDADE_ITEM;
ALTER TABLE UF_CIDADE_ITEM DROP INDEX UN_UF_CIDADE_ITEM;
ALTER TABLE USUARIO DROP INDEX UN_TX_EMAIL;
ALTER TABLE USUARIO DROP INDEX UN_TX_CODIGO_ATIVACAO;
ALTER TABLE USUARIO_VERSAO DROP INDEX UN_USVE_USUA_VERS;
ALTER TABLE USUARIO_VERSAO DROP INDEX UN_USVE_USUA_VERS;
ALTER TABLE VARIAVEL DROP INDEX UN_VARI_NM_VARIAVEL;
ALTER TABLE CAMPANHA_TOPDEZ DROP INDEX UIX_CATO_CAMP_USUA;
ALTER TABLE CAMPANHA_TOPDEZ DROP INDEX UIX_CATO_CAMP_USUA;
ALTER TABLE CFDI DROP INDEX UIX_CFDI_TX_QRCODE_REGIST;
ALTER TABLE PLANO_RECURSO DROP INDEX UIX_PLRE_USUA_RECU;
ALTER TABLE PLANO_RECURSO DROP INDEX UIX_PLRE_USUA_RECU;
ALTER TABLE REGISTRO_INDICACAO DROP INDEX UIX_FIPO_USUA_ID;
ALTER TABLE REGISTRO_INDICACAO DROP INDEX UIX_FIPO_USUA_ID;
DROP TABLE CAMPANHA;
DROP TABLE CAMPANHA_CASHBACK;
DROP TABLE CAMPANHA_CASHBACK_CC;
DROP TABLE CAMPANHA_CASHBACK_RESGATE_PIX;
DROP TABLE CAMPANHA_HISTORICO;
DROP TABLE CAMPANHA_QRCODES;
DROP TABLE CAMPANHA_SORTEIO;
DROP TABLE CAMPANHA_SORTEIO_FILA_CRIACAO;
DROP TABLE CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS;
DROP TABLE CAMPANHA_TOPDEZ;
DROP TABLE CARTAO;
DROP TABLE CARTAO_HISTORICO;
DROP TABLE CARTAO_MOVER_HISTORICO;
DROP TABLE CARTAO_PEDIDO;
DROP TABLE CFDI;
DROP TABLE CIDADE;
DROP TABLE CONTATO;
DROP TABLE ESTATISTICA_FUNCAO;
DROP TABLE ESTATISTICA_FUNCAO_07D;
DROP TABLE ESTATISTICA_FUNCAO_14D;
DROP TABLE ESTATISTICA_FUNCAO_30D;
DROP TABLE FILA_EMAIL;
DROP TABLE FILA_PUBLICIDADE;
DROP TABLE FILA_QRCODES_PNDNT_PRD;
DROP TABLE FUNDO_PARTICIPACAO_GLOBAL;
DROP TABLE INDICADOR_PROGRESSO;
DROP TABLE JOBS;
DROP TABLE MENSAGEM;
DROP TABLE MKD_CAMPANHA_EMAIL;
DROP TABLE MKD_EMAIL_LISTA;
DROP TABLE PLANOS;
DROP TABLE PLANO_RECURSO;
DROP TABLE PLANO_USUARIO;
DROP TABLE PLANO_USUARIO_FATURA;
DROP TABLE QRCODES_CURINGA;
DROP TABLE RECURSO;
DROP TABLE REGISTRO_INDICACAO;
DROP TABLE SEGLOG_FUNCOES_ADMINISTRATIVAS;
DROP TABLE SEGLOG_GRUPO_ADMINISTRACAO;
DROP TABLE SEGLOG_GRUPO_ADM_FUNCAO_ADM;
DROP TABLE SEGLOG_GRUPO_USUARIO;
DROP TABLE SESSAO;
DROP TABLE TIPO_EMPREENDIMENTO;
DROP TABLE TRACE;
DROP TABLE UF;
DROP TABLE UF_CIDADE_ITEM;
DROP TABLE USUARIO;
DROP TABLE USUARIO_AUTORIZADOR;
DROP TABLE USUARIO_AVALIACAO;
DROP TABLE USUARIO_CAMPANHA_SORTEIO;
DROP TABLE USUARIO_CAMPANHA_SORTEIO_TICKETS;
DROP TABLE USUARIO_CASHBACK;
DROP TABLE USUARIO_COMPLEMENTO;
DROP TABLE USUARIO_NOTIFICACAO;
DROP TABLE USUARIO_PUBLICIDADE;
DROP TABLE USUARIO_TIPO_EMPREENDIMENTO;
DROP TABLE USUARIO_TROCA_SENHA_HISTORICO;
DROP TABLE USUARIO_VERSAO;
DROP TABLE VARIAVEL;
DROP TABLE VERSAO;


/* COLE AQUI O RESULTADO DA QUERY ACIMA */

SET FOREIGN_KEY_CHECKS=1;

