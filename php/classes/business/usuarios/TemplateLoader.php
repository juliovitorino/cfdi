<?php  

/**
* TemplateLoader - Carrega um dado arquivo texto e devolve seu conteúdo
*/
class TemplateLoader
{
	private $fullpath;
	private $conteudo;
	
	function __construct($fullpath)
	{
		$this->fullpath = $fullpath;
		$this->carregar();
	}

	private function carregar(){
/*		echo 'conteudo carregado hardcode do arquivo via classe TemplateLoader em '.$this->fullpath.'<br>';*/
		$this->conteudo = file_get_contents($this->fullpath);
	}

	public function getConteudo() {
		return $this->conteudo;
	}


}

?>