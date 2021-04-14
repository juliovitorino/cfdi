<?php
require_once 'UsuarioService.php';
require_once 'UsuarioDTO.php';

$dto = new UsuarioDTO();
$dto->email = "julio.vitorino@gmail.com";

$us = new UsuarioService();
$dto = $us->buscarProjetoOficial($dto);

var_dump($dto);
?>