<?php

require_once '../interfaces/DAO.php';

/**
* CidadeDAO - Extensão da interface padrão de DAO
*/
interface CidadeDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCidadeStatus($status);
    public function countCidadePorStatus($status);
    public function listCidadePorStatus($status, $pag, $qtde, $coluna, $ordem);
}
?>
