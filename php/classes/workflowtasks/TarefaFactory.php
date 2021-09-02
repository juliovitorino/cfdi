<?php

require_once './ITarefa.php';
require_once './TarefaProcessarFilaFaleConosco.php';
require_once './TarefaMoverEmailFaleConoscoFilaEmail.php';
/**
 * TarefaFactory - Fabrica de Objetos que implementam ITarefa
 *
 * @author Julio Vitorino
 * @since 01/09/2021
 */

abstract class TarefaFactory 
{
	/* anula construtor */
	private function __construct()	{}

	/**
	 * Retorna a instancia das fabricas ITarefa 
	 * @return ITarefa.
	 */
	public static function getInstance($idtarefa) 
	{
		// Verifica qual instancia de factory de dados retornar
		switch ($idtarefa) {
			case 1:
				return new TarefaProcessarFilaFaleConosco();
			case 2:
				return new TarefaMoverEmailFaleConoscoFilaEmail();
			
			default:
				# code...
				break;
		}
	}

}
?>
