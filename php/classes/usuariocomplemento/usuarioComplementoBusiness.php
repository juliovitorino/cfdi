<?php

/**
* 
* UsuarioComplementoBusiness
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioComplementoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioComplementoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
}

?>
