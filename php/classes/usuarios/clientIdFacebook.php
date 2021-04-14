<?php  

// importar dependencias
require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

// id fcbk julio.vitorino.50
$idfcbk = '2278008755575813';
$usi = new UsuarioServiceImpl();
$ok = $usi->pesquisarPorIdFacebook($idfcbk);
var_dump($ok);
$ok = $usi->pesquisarPorId('113');
var_dump($ok);


?>