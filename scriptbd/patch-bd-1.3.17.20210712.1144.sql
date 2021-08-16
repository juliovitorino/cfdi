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


/* UPDATES NECESSÁRIOS */


