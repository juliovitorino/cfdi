<?php

require_once '../interfaces/DAO.php';

/**
* UsuarioTipoEmpreendimentoDAO - Extensão da interface padrão de DAO
*/
interface UsuarioTipoEmpreendimentoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioTipoEmpreendimentoStatus($status);
}
?>
