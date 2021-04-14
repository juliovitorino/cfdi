<?php  

require_once '../chain/AbstractChainOfResponsability.php';
/**
 * 
 */
class MainCor extends AbstractChainOfResponsability
{
	
	public function setContext($pdto)
	{
		$this->pdto = $pdto;
	}

}

?>