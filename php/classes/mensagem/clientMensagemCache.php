<?php  

require_once 'MensagemCache.php';
require_once 'ConstantesMensagem.php';


$mc = MensagemCache::getInstance();
echo $mc->getMensagem('MSG-0001');

echo "<br>";

// comando em uma linha
echo MensagemCache::getInstance()->getMensagem(ConstantesMensagem::MSGCODE_COMANDO_REALIZADO_COM_SUCESSO);
echo "<br>";
echo MensagemCache::getInstance()->getMensagem(ConstantesMensagem::MSGCODE_ERRO_INESPERADO);

?>