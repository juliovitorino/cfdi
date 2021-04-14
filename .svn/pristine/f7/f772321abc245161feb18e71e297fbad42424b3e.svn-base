<?php  

/**
 * AbstractChainOfResponsability - Abstração do design pattern Chain Of Responsability
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 16/08/2018
 */
 abstract class AbstractChainOfResponsability {
	
	private $lst = [];
	private $daofactory;
	protected $pdto;
	private $iserro = false;

	abstract function setContext($pdto);

	/**
	 * addChain - Adiciona cada chain dentro da ordem de execução sequencial
	 * @param $item - Chain
	 */
	public function setErro($value = false)
	{
		$iserro = $value;
	}
	
	/**
	 * addChain - Adiciona cada chain dentro da ordem de execução sequencial
	 * @param $item - Chain
	 */
	public function addChain($item){
		$this->lst[] = $item;
	}
	
	/**
	 * setContextDAO - Guarda um contexto de DAO para uso nas chains se necessário
	 * @param $daofactory
	 */
	public function setContextDAO($daofactory) {
		$this->daofactory = $daofactory;
	}

	public function execute() {
		if (!is_null($this->lst)){
			if(sizeof($this->lst) > 0){
				foreach ($this->lst as $key => $value) {
					if ($this->iserro){
						break;
					}
					$value->setContextDAO($this->daofactory);
					$value->execute($this->pdto);
				}
			}
		}
		if ($this->iserro)
		{
			echo "erro na anterior do objeto " . get_class($value);
		}

	}
}
?>