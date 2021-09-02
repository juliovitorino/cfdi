<?php

require_once './AbstractTarefa.php';
require_once '../contato/ContatoServiceImpl.php';
require_once '../contato/ContatoConstantes.php';

/**
 * TarefaMoverEmailFaleConoscoFilaEmail - Implementa métodos para interface ITarefa
 * 
 * As classes concretas deverão implementar os métodos definidos na interface ITarefa.
 *
 * @author Julio Vitorino
 * @since 01/09/2021
 */

class TarefaMoverEmailFaleConoscoFilaEmail extends AbstractTarefa {

	function __construct() 	{}

    public function executar()
    {
        $contatosvc = new ContatoServiceImpl();
        return $contatosvc->enviarRegistroContatoFilaEmail(ContatoConstantes::ORIGEM_FALE_CONOSCO);
    }
    
}

?>