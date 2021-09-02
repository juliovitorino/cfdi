<?php

require_once './ITarefa.php';

/**
 * AbstractTarefa - Abstração de uma interface ITarefa
 * 
 * As classes concretas deverão implementar os métodos definidos na interface ITarefa.
 *
 * @author Julio Vitorino
 * @since 01/09/2021
 */

 abstract class AbstractTarefa implements ITarefa {
    
    //protected $daofactory = NULL;
	

	/* anula construtor porque iremos pedir as concretas atraves de uma factory */
	private function __construct()	{}

    //-------------------------------------------------------------------
    // definição de atributos da abstração
    //-------------------------------------------------------------------

    public $parentTarefa = array(); // Ponteiros arrays para as tarefas anteriores
    public $childTarefa = array();  // Ponteiros arrays para as tarefas posteriores
    public $usuaid;

    //-----------------------------------
    // métodos da abstração
    //-----------------------------------


 }

?>