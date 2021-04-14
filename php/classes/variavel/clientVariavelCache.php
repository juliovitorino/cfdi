<?php  

// http://localhost/cfdi/php/classes/variavel/clientVariavelCache.php
require_once 'VariavelCache.php';
require_once 'ConstantesVariavel.php';


$mc = VariavelCache::getInstance();
echo $mc->getVariavel(ConstantesVariavel::CANIVETE_VERSAO);

echo "<br>";

// comando em uma linha
echo VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CANIVETE_VERSAO) . '<br>';
echo VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CANIVETE_COPY);

var_dump(VariavelCache::getInstance()->getSysinfo());

?>