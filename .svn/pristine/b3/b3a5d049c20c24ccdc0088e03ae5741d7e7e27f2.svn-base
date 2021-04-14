<?php  

// Importar dependências
require_once 'ConcreteLoaderCSVExportKeywordExata.php';

require_once '../keywordrelated/keywordRelatedDTO.php';

/**
 * AbstractLoaderCSV - Abstração dos loaders
 */
abstract class AbstractLoaderCSV
{

	private $linhas = [];
	
	private function __construct()	{	}

	abstract public function getKeywordVolume($prkeid, $patharquivo);
	abstract public function getDadosConcorrentes();

	public static function getInstance($tipo)
	{
		switch ($tipo) {
			case ConstantesLoaderCSV::LOADER_CSV_PALAVRA_CHAVE_EXATA:
				return new ConcreteLoaderCSVExportKeywordExata();
			
			default:
				# code...
				break;
		}
	}

	/**
	* Carrega o CSV para dentro de um array
	*/
	protected function loaderCSV($prkeid, $arquivo) {
		$file = fopen($arquivo,"r");

		// Leitura do arquivo CSV para o array
		while(! feof($file)) {
			$linha = fgets($file);
			$linha = str_replace('"', '', $linha);
			$linhasplit = explode(';', $linha);

			var_dump($linha);

			// transforma a linha em uma KeywordDTO()
			$keydto = new KeywordRelatedDTO();
			$keydto->keywordParentid = $prkeid;
			$keydto->keyword = $linhasplit[ConstantesLoaderCSV::COL_KEYWORD];
			$keydto->volumepesquisa = $linhasplit[ConstantesLoaderCSV::COL_SEARCH_VOLUME];
			$keydto->valorcpc = $linhasplit[ConstantesLoaderCSV::COL_CPC];
			$keydto->niveldificuldade = floatval($linhasplit[ConstantesLoaderCSV::COL_COMPETITION]) * 100;
			$keydto->numeroResultados = $linhasplit[ConstantesLoaderCSV::COL_NUMBER_OF_RESULTS];
			$keydto->tendencia = $linhasplit[ConstantesLoaderCSV::COL_TRENDS];

			$this->linhas[] = $keydto;
		}

		fclose($file);		
	}

	public function getLinhas()	{
		return $this->linhas;
	}
}
?>