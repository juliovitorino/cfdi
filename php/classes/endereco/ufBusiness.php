<?php

/**
* 
* UfBusiness
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UfBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUfPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
}

?>