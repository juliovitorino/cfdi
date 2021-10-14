<?php

require_once 'ITarefa.php';
require_once 'TarefaProcessarFilaEmail.php';
require_once 'TarefaMoverEmailFaleConoscoFilaEmail.php';
require_once 'TarefaConstantes.php';

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
			case TarefaConstantes::TAREFA_PROCESSAR_FILA_FALE_CONOSCO:
				return new TarefaProcessarFilaEmail();
			case TarefaConstantes::TAREFA_MOVER_EMAIL_CONTATO_FILA_EMAIL:
				return new TarefaMoverEmailFaleConoscoFilaEmail();
			
			default:
				# code...
				break;
		}
	}

}
?>
