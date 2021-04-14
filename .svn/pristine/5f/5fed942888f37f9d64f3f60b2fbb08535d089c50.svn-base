<?php
require_once 'UsuarioServiceImpl.php';
require_once 'ProjetoDTO.php';
require_once 'ProjetoDetalheDTO.php';

$ts = time();
$us = new UsuarioServiceImpl();

$dto = new ProjetoDetalheDTO();
$dto->projetoid = 1;

$dto->desc = "descricao item " . $ts;
$ok = $us->cadastrarProjetoItem($dto->projetoid, $dto->desc, 'projeto-item');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}

$dto->desc = "descricao bonus " . $ts;
$ok = $us->cadastrarProjetoItem($dto->projetoid, $dto->desc, 'projeto-bonus');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}

$dto->desc = "descricao tecnicas " . $ts;
$ok = $us->cadastrarProjetoItem($dto->projetoid, $dto->desc, 'projeto-tecnicas');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}

$dto->desc = "descricao dores " . $ts;
$ok = $us->cadastrarProjetoItem($dto->projetoid, $dto->desc, 'projeto-dores');
if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}

$dto->desc = "descricao beneficios " . $ts;
$ok = $us->cadastrarProjetoItem($dto->projetoid, $dto->desc, 'projeto-beneficios');

if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";
}
?>