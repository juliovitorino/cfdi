<?php  

require_once '../chain/AbstractChain.php';

/**
 * 
 */
class aChain extends AbstractChain
{
	function __construct($cor)
	{
		parent::setContextCOR($cor);
	}

	public function execute($contexto) {
		echo "execute()::aChain<br>";
		echo "contexto: " . $contexto;
		$this->setContext($contexto);
	}
	

}
?>