<?php  

/**
 * AbstractChain - Abstração do design pattern Chain para uma Chain Of Responsability
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 16/08/2018
 */
abstract class AbstractChain {
	
	protected $context;
	protected $contextAuxiliar;
	protected $cor;
	protected $daofactory;

	abstract protected function execute($context);
	
	public function setContextCOR($cor){
		$this->cor = $cor;
	}
	
	public function getContextCOR(){
		return $this->cor;
	}
	
	public function setContext($context){
		$this->context = $context;
	}

	public function setContextAuxiliar($context){
		$this->contextAuxiliar = $context;
	}
	
	public function setContextDAO($daofactory){
		$this->daofactory = $daofactory;
	}
	
	public function getContext(){
		return $this->context;
	}

	public function getContextAuxiliar(){
		return $this->contextAuxiliar;
	}

}

?>