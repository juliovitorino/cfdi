<?php
require_once 'UsuarioServiceImpl.php';
require_once 'ProjetoDTO.php';

$us = new UsuarioServiceImpl();

$ok = $us->apagarProjetoItem(1,'projeto-item');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
$ok = $us->apagarProjetoItem(1,'projeto-bonus');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
$ok = $us->apagarProjetoItem(102,'projeto-tecnicas');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
$ok = $us->apagarProjetoItem(3,'projeto-dores');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
$ok = $us->apagarProjetoItem(100,'projeto-beneficios');

if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
?>