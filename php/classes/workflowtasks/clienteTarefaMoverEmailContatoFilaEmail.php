<?php

// http://elitefinanceira.com/cfdi/php/classes/workflowtasks/clienteTarefaMoverEmailContatoFilaEmail.php

require_once 'TarefaFactory.php';
require_once 'TarefaConstantes.php';

$tarefa2 = TarefaFactory::getInstance(TarefaConstantes::TAREFA_MOVER_EMAIL_CONTATO_FILA_EMAIL);
$contexto = array();
echo json_encode($tarefa2->executar($contexto));

?>
