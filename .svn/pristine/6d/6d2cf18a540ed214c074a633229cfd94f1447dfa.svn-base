<?php

require_once 'ConstantesTBodyFactory.php';
require_once 'TBodyProjetoConcrete.php';

/**
 * TbodyFactory - Fabrica de carregamentos dos elementos tbody
 */
abstract class TBodyFactory
{
	
	private function __construct() { }

	/**
	* getInstance() - Retorna uma instância concreta de um objeto específico
	* de tratamento de tbodys
	*/
	public static function getInstance($tipo, $dto)
    {
    	switch ($tipo) {
    		case ConstantesTBodyFactory::CONCRETE_PROJETO:
    			return new TBodyProjetoConcrete($dto);

    		default:
    			break;
    	}
        
    }

    // abstração obrigatória para as factories
    abstract function execute();

}

?>