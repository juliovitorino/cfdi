<?php  

/**
 * 
 */
class bChain extends AbstractChain
{
	
	function __construct($cor)
	{
		parent::setContextCOR($cor);
	}


	public function execute($contexto) {
		echo "execute()::bChain<br>";
		echo "contexto: " . $contexto . '<br>';
		$this->setContext($contexto);
		echo "contexto bChain: " .$this->getContext() . '<br>';

	}
	

}
?>