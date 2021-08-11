
-- conectar via linha de comando
--# mysql -h localhost -u cfd -p 
--# Enter password: *****************
--# Welcome to the MySQL monitor.  Commands end with ; or \g.
--# Your MySQL connection id is 5
--# Server version: 5.7.26 MySQL Community Server (GPL)

--# Copyright (c) 2000, 2019, Oracle and/or its affiliates. All rights reserved.
--# Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

--# mysql> show tables;
--# mysql> connect cfd;
--# Connection id:    6
--# Current database: cfd
--# mysql> show tables;


SELECT A.UFCI_ID,A.CIDA_ID,A.UF_ID,B.CIDA_NM_CIDADE
FROM `UF_CIDADE_ITEM` A
INNER JOIN CIDADE B ON A.CIDA_ID = B.CIDA_ID
WHERE `UFCI_TX_DDD` is null
order BY A.UF_ID,B.CIDA_NM_CIDADE


INSERT INTO `CAMPANHA_CASHBACK`(`CAMP_ID`, `CACA_TX_TITULO`, `CACA_TX_DESCRICAO`, `CACA_VL_MIN`, `CACA_VL_RESGATE`, `CACA_VL_PERC_CASHBACK`, `CACA_DT_TERMINO`, `CACA_TX_OBS`) VALUES (
1000,
    'outra campanha de cash back',
    'ipsum lorem',
    25,
    260,
    1,
    date_add(CURRENT_TIMESTAMP,INTERVAL 500 DAY),
    'obs'
)

-- inserir notificação para todos os usuários do tipo conta COMUM

SELECT CONCAT('insert into USUARIO_NOTIFICACAO (USUA_ID,USNO_TX_NOTIFICACAO,USNO_TX_ICON) VALUES(',USUA_ID,',','''', `USUA_TX_NOME`,
' agora Kiriatti Empório Culinária Japonesa está com Junta10 - R. José Fulgêncio Neto, 147 - Aterrado, Volta Redonda - RJ, 27213-340, Telefone: (24) 3346-8629',''',','''notify-03.png''',');') 
FROM `USUARIO` 
WHERE `USUA_IN_TIPO_CONTA`='C'


// script para criar URL de apoio aos testes de validação do qrcode e completar o cartao
select concat('http://localhost/cfdi/php/classes/gateway/validarQrcodeController.php?qrc=',caqr_tx_qrcode,'&token=8955451b4016d06c0cdc04c39fe71ae8a5d7c0c1')
from `campanha_qrcodes`
where camp_id = 22
and caqr_in_status = 'A'


/* Query para saber se a campanha atingiu percentual de carimbos distribuidos */
/* TESTAR A CAPACIDADE DE CARIMBAGEM DA CAMPANHA ACIM DE 70% PARA RODAR ROBO DE CRIAÇÃO DE CARIMBOS */
select *
from CAMPANHA
where CAMP_TT_CARIMBADOS / CAMP_TT_CARIMBOS > 0.7
.

/* TESTAR SE EXISTE REPETIÇÃO DE TICKETS REDUZIDOS EM CAMPANHA_QRCODES */

select CAQR_TX_TICKET, count(CAQR_TX_TICKET)
from CAMPANHA_QRCODES
where CAQR_IN_STATUS = 'A'
GROUP BY CAQR_TX_TICKET
HAVING count(CAQR_TX_TICKET) > 1

/* select para saber se tem número repetido na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS */
SELECT CSNP_NU_SORTEIO, COUNT(CSNP_NU_SORTEIO)
FROM CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS
WHERE CASO_ID = :CASO_ID
GROUP BY CSNP_NU_SORTEIO
HAVING COUNT(CSNP_NU_SORTEIO) > 1

/* query para ver lista de divida no cashback de um determinado usua_id*/
SELECT a.`USUA_ID`
, b.USUA_TX_NOME
, SUM(a.CACC_VL_RECOMPENSA) AS 'RECOMPENSA'
FROM CAMPANHA_CASHBACK_CC a INNER JOIN USUARIO b ON a.`USUA_ID` = b.USUA_ID
WHERE 
a.USUA_ID_DONO = :USUA_ID_DEVEDOR
AND a.CACC_IN_TIPO IN ('C','D')
AND a.CACC_IN_STATUS = 'A'
GROUP BY a.`USUA_ID`
HAVING SUM(a.CACC_VL_RECOMPENSA) > 0
ORDER BY 3 DESC

/* query para localizar usuário promotor e seus indicados */
SELECT A.USUA_ID_PROMOTOR
, B.USUA_TX_NOME
, A.USUA_ID_INDICADO
, C.USUA_TX_NOME
, C.USUA_TX_EMAIL
, C.USUA_TX_URLPICFCBK
FROM REGISTRO_INDICACAO A INNER JOIN USUARIO B 
                          ON A.USUA_ID_PROMOTOR = B.USUA_ID
                          INNER JOIN USUARIO C
                          ON A.USUA_ID_INDICADO = C.USUA_ID 
WHERE A.USUA_ID_PROMOTOR = 1000;                       

/* QUERY PARA OBTER TODOS OS NÚMEROS DE SORTEIO DE UM DETERMINADO USUARIO EM TODAS AS CAMPANHAS */
SELECT  D.CASO_TX_NOME
, C.USUA_TX_NOME
, A.UCST_NU_TICKET

FROM USUARIO_CAMPANHA_SORTEIO_TICKETS A 
INNER JOIN USUARIO_CAMPANHA_SORTEIO B ON A.USCS_ID = B.USCS_ID
INNER JOIN USUARIO C ON B.USUA_ID = C.USUA_ID
INNER JOIN CAMPANHA_SORTEIO D ON B.CASO_ID = D.CASO_ID
WHERE C.USUA_ID = 1003;