<?php

require_once './TarefaFactory.php';

////$tarefa1 = TarefaFactory::getInstance(1);
$tarefa2 = TarefaFactory::getInstance(2);

//echo json_encode($tarefa1->executar());
echo json_encode($tarefa2->executar());

?>
