<?php  
// URL http://localhost/cfdi/php/classes/usuarios/clientPesquisarPerfilUsuario.php
// URL http://junta10.dsv:8080/cfdi/php/classes/usuarios/clientPesquisarPerfilUsuario.php

// importar dependencias
require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';


$id = 1000;
$usi = new UsuarioServiceImpl();
$retorno = $usi->pesquisarPerfilCompleto($id);

echo json_encode($retorno);


?>