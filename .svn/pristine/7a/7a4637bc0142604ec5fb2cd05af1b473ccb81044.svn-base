<?php

/**
 * ListaBeneficiosConcrete - Fabrica de array $key => $value para tipo ul > li
 */
class ListaBeneficiosConcrete extends ListaFactory
{
	
	function __construct($arraylist)
	{
		$this->arraylist = $arraylist;
	}

	/**
	 * getListaHtml() - Retorna o arraylist no formato ul > li
	 * @return string
	 */
	public function getListaHtml()
	{
		$retorno = '';
		foreach ($this->arraylist as $key => $value) {
			$retorno = $retorno . '<li>' . $value->desc . '</li>';
		}
		return '<ul>' . $retorno . '</ul>';
	}

}

?>