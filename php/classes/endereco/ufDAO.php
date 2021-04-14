<?php

require_once '../interfaces/DAO.php';

/**
* UfDAO - Extensão da interface padrão de DAO
*/
interface UfDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUfStatus($status);
    public function countUfPorStatus($status);
    public function listUfPorStatus($status, $pag, $qtde, $coluna, $ordem);
}
?>
