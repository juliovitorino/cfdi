<?php  

require_once 'abstractLoaderCSV.php';
require_once 'ConstantesLoaderCSV.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';

// sintaxe: <home>/gc/php/classes/loadercsv/loaderPalavraChaveRelacionadaController.php?prkeid=<codigo>

// Obtem dados do post
$prkeid = $_GET['prkeid'];
var_dump($prkeid);

// Obtem path para carga de todos os arquivos
$path = getcwd() . VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_LOADER_KWD_RELATED);
$path = str_replace("*=prkeid=*", $prkeid, $path);
var_dump($path);

// Determina qual factory vai resolver o loader
$csv = AbstractLoaderCSV::getInstance(ConstantesLoaderCSV::LOADER_CSV_PALAVRA_CHAVE_EXATA);

// Leitura de todas os exports realizados pelo SemRush e o MOZ
$files = scandir($path);
var_dump($files);

foreach ($files as $key => $arquivo) {
	if ( ($arquivo !== '.') && ($arquivo !== '..') ){	
		$csv->getKeywordVolume($prkeid, $path . '/' . $arquivo );
	}
}
