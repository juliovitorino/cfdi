<?php
// http://elitefinanceira.com/cfdi/php/classes/workflowtasks/clienteTarefaProcessarFilaEmail.php

require_once 'TarefaFactory.php';
require_once 'TarefaConstantes.php';

$tarefa = TarefaFactory::getInstance(TarefaConstantes::TAREFA_PROCESSAR_FILA_FALE_CONOSCO);
$context = [
    'fila' => FilaEmailConstantes::FIEM_CONTATO_PELO_FALE_CONOSCO_SITE
];
echo json_encode($tarefa->executar($context));

?>
