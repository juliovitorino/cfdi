<?php

require_once './AbstractTarefa.php';

/**
 * TarefaProcessarFilaFaleConosco - Implementa métodos para interface ITarefa
 * 
 * A função dessa classe é executar processos envolvendo a Fila de Email que tem pendencia com
 * Fale Conosco
 * 
 * As classes concretas deverão implementar os métodos definidos na interface ITarefa.
 *
 * @author Julio Vitorino
 * @since 01/09/2021
 */

class TarefaProcessarFilaFaleConosco extends AbstractTarefa {

	function __construct()	{}

    public function executar()
    {
        return "{msg: 'TarefaProcessarFilaFaleConosco::executar() foi realizado.'}";
    }
    
}

?>