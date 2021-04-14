<?php
require_once 'UsuarioBusiness.php';
require_once 'UsuarioDTO.php';

$dto = new UsuarioDTO();
$dto->email = "julio.vitorino@gmail.com";

$bo = new UsuarioBusiness();
$dto = $bo->carregar($dto);

var_dump($dto);
?>