<?php

require_once '../interfaces/DAO.php';

/**
* UsuarioComplementoDAO - Extensão da interface padrão de DAO
*/
interface UsuarioComplementoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioComplementoStatus($status);
    public function countUsuarioComplementoPorStatus($status);
    public function listUsuarioComplementoPorStatus($status, $pag, $qtde, $coluna, $ordem);
}
?>
