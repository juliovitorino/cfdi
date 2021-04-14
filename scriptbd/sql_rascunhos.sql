CREATE OR REPLACE VIEW VW_QRCODE_ID_GENERATOR
AS
SELECT  MIN(a.CAQR_ID) as ID,
        a.CAMP_ID, 
        c.USUA_ID
FROM `campanha_qrcodes` a
INNER JOIN `campanha` b ON a.CAMP_ID = b.CAMP_ID
INNER JOIN `usuario` c ON b.USUA_ID = c.USUA_ID
WHERE a.caqr_in_status = 'A'
GROUP BY a.CAMP_ID, c.USUA_ID



Resolução do problema cashback CC

1) Eu sou cliente de quem no cashback?
====================================
select distinct USUA_ID_DONO from CAMPANHA_CASHBACK_CC where USUA_ID = 7;
R: Clientes 4 e 9

2- obter o CC completo do cliente em função do dono da campanha. Faz para o 4 e depois para 9
a) Me dê os ID saldos dos respectivos 
select max(CACC_ID) as MaiorId from `campanha_cashback_cc` where `USUA_ID` = 7
and `USUA_ID_DONO` = 4 and CACC_IN_TIPO = 'S';
R: 1040 -> X

b) Obtem o registro completo do saldo por PK
select * from  `campanha_cashback_cc` where  CACC_ID = 1040;

b.1) já aproveita pra acumular o saldo um um totalizador do objeto

c) pegar movim CC id > X, tipo <> 'S' usua_id =7 e dono 4
select * from  `campanha_cashback_cc` where `USUA_ID` = 7
and `USUA_ID_DONO` = 4 and CACC_IN_TIPO IN ('C','D') and CACC_ID > 1040;


R: Se resultado de (a) for Null, ou seja, nunca foi computado o saldo, logo qq lançamento ID > 0 
do mesmo usuario e dono é movimento de CC
