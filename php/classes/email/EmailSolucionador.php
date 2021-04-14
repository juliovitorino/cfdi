<?php  
/**
 * EmailSolucionador - Solucionador de templates de emails e tags
 * PHP Version 5.6
 *
 * @author Julio Vitorino (julio.vitorino@gmail.com)
 * @copyright 2018 - 2018 Julio Vitorino
 */

// importar dependencias
require_once '../composite/TemplateLoader.php';

/**
 * EmailSolucionador
 */
class EmailSolucionador
{
	public $emaildto;
	private $conteudo;
	
	function __construct($emaildto)
	{
		$this->emaildto = $emaildto;
	}

	/**
	* execute() - Executa a carga do template e realiza as trocas das tags
	*/
	public function execute() 
	{
		$tl = new TemplateLoader($this->emaildto->template);

		$temp = $tl->getConteudo();
		foreach ($this->emaildto->lsttags as $key => $value) {
			$temp = str_replace($key,$value,$temp);
		}
		$this->conteudo = $temp;

	}

	public function getConteudo()
	{
		return $this->conteudo;
	}


}

?>