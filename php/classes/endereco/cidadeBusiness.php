<?php

/**
* 
* CidadeBusiness
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CidadeBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
}

?>
