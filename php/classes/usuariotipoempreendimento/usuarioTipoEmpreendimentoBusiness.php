<?php

/**
* 
* UsuarioTipoEmpreendimentoBusiness
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioTipoEmpreendimentoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioTipoEmpreendimentoPorStatus($daofactory, $status);
}

?>
