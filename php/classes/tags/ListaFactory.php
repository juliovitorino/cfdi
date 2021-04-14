<?php 

/**
* ListaFactory - Abstração para criação de classes concretas 
* para resolver arrays em lista 
* @author Julio Vitorino
* @since 02/08/2018
*/

/* importa dependências */
require_once 'ConstantesTag.php';
require_once 'ListaBonusConcrete.php';
require_once 'ListaItensConcrete.php';
require_once 'ListaDoresConcrete.php';
require_once 'ListaBeneficiosConcrete.php';
require_once 'ListaTecnicasConcrete.php';

abstract class ListaFactory
{

	protected $arraylist;

	/**
	* getInstance() - Retorna uma instância concreta de um objeto específico
	* de tratamento de arrays
	*/
	public static function getInstance($tipo, $arraylist)
    {
    	switch ($tipo) {
            case ConstantesTag::COMMAND_LISTA_BONUS:
                return new ListaBonusConcrete($arraylist);

            case ConstantesTag::COMMAND_LISTA_ITENS:
                return new ListaItensConcrete($arraylist);

            case ConstantesTag::COMMAND_LISTA_DORES:
                return new ListaDoresConcrete($arraylist);

            case ConstantesTag::COMMAND_LISTA_BENEFICIOS:
                return new ListaBeneficiosConcrete($arraylist);

            case ConstantesTag::COMMAND_LISTA_TECNICAS:
                return new ListaTecnicasConcrete($arraylist);

    		default:
    			break;
    	}
        
    }

    // implementações a serem realizadas pelas heranças
    abstract function getListaHtml();

}



?>