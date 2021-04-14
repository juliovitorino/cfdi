<?php  

require_once 'abstractLoaderCSV.php';
require_once 'ConstantesLoaderCSV.php';

$csv = AbstractLoaderCSV::getInstance(ConstantesLoaderCSV::LOADER_CSV_PALAVRA_CHAVE_EXATA);
$csv->getKeywordVolume();


?>