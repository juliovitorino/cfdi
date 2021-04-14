
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