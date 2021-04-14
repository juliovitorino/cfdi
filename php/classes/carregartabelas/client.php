<?php

require_once '../usuarios/UsuarioDTO.php';
require_once '../usuarios/UsuarioBusiness.php';


// Recupero os dados do usuário e seus projetos
$dto = new UsuarioDTO();
$dto->email = "julio.vitorino@gmail.com";
//$dto->email = $obj->usuario->email;

$bo = new UsuarioBusiness();
$dto = $bo->carregar($dto);

// retorna resultado
echo json_encode($dto);

?>