<?php  

// http://localhost/cfdi/php/classes/usuarios/clientAtivarConta.php

// importar dependencias
require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';

$token = "hShRs7XoO2MEhWWAtJlEJsuAF348QX2gqRJzthVBCytSrJfmDlOt8olRexicaYt9RZlFrzbsMKB8aU7XhUYrnBU7H2xdRjGtnTLxlXpFuPt0314HIsXMCOuDvys2ryI";
$usi = new UsuarioServiceImpl();
$ok = $usi->habilitarContaPorEmail($token);

echo $ok->msgcode . "<br>";
echo $ok->msgcodeString . "<br>";


?>