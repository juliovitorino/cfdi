/* query para extrair as FK do MySql Schema cfd */
mysql -h localhost -u cfd -p

connect cfd;

select concat('ALTER TABLE ',TABLE_NAME,' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';')
from information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cfd'
AND CONSTRAINT_NAME LIKE 'FK_%';

/* EXECUTE A SQL ABAIXO */
select concat('ALTER TABLE ',TABLE_NAME,' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';')
from information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cfd'
AND CONSTRAINT_NAME LIKE 'FK_%'
UNION ALL
select concat('ALTER TABLE ',TABLE_NAME,' DROP INDEX ', CONSTRAINT_NAME, ';')
from information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cfd'
AND CONSTRAINT_NAME LIKE 'UN_%'
UNION ALL
select concat('ALTER TABLE ',TABLE_NAME,' DROP INDEX ', CONSTRAINT_NAME, ';')
from information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cfd'
AND CONSTRAINT_NAME LIKE 'UIX_%'
UNION ALL
select concat('ALTER TABLE ',TABLE_NAME,' DROP INDEX ', CONSTRAINT_NAME, ';')
from information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cfd'
AND CONSTRAINT_NAME LIKE 'IX_%'
UNION ALL
SELECT concat('DROP TABLE ', Table_name, ';')
from information_schema. tables where table_schema = 'cfd'
INTO OUTFILE '/temp/drop-all-commands.txt';


/* desabilita todas FKs para efetivar o DROP TABLE */
SET FOREIGN_KEY_CHECKS=0;

/* COLE AQUI O RESULTADO DA QUERY ACIMA */

SET FOREIGN_KEY_CHECKS=1;
