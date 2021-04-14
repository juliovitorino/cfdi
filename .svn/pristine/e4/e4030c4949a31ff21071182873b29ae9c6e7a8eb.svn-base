<?php
ob_start();

require_once 'UsuarioServiceImpl.php';
require_once 'UsuarioDTO.php';

$us = new UsuarioServiceImpl();
$dto = $us->buscarTodosProjetos(1);

var_dump($dto);

ob_flush();
?>