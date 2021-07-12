-- DML
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CHAVE_PERMITIR_BONIFICACAO_J10','Chave Geral Permitir J10 bonificar financeiramente ao carimbar cartão' ,'OFF');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('VALOR_CASHBACK_CC_BONIFICACAO_J10','Valor credito de cashback J10 bonificação financeira ao carimbar cartão' ,'0.50');
INSERT INTO VARIAVEL (`VARI_NM_VARIAVEL`,`VARI_TX_DESCRICAO`,`VARI_TX_VALOR_CONTEUDO`) VALUES ('CODIGO_CASHBACK_BONIFICACAO_J10','Código Campanha Cashback (CACA_ID) referencia ao carimbar cartão' ,'0');

INSERT INTO `MENSAGEM` (`MENS_TX_MSGCODE`, `MENS_TX_MENSAGEM`) VALUES ('MSG-0170','credito de bonificação de *=p1=* por carimbar seu cartão na campanha *=p2=* de nossa rede credenciada');

