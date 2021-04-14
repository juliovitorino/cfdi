<?php  

// importar dependencias
require_once '../keywordrelated/keywordRelatedServiceImpl.php';

/**
 * 
 */
class ConcreteLoaderCSVExportKeywordExata extends AbstractLoaderCSV
{
	
	function __construct()
	{
		# code...
	}

	public function getKeywordVolume($prkeid,$patharquivo) {
		var_dump($prkeid);
		var_dump($patharquivo);

		$this->loaderCSV($prkeid, $patharquivo);


		$ksi = new KeywordRelatedServiceImpl();
		$csv = $this->getLinhas();

		for($i=1; $i < sizeof($csv); $i++){
	        $retorno = $ksi->cadastrar($csv[$i]);
		}
	}

	public function getDadosConcorrentes(){
		return 0;
	}

}

?>