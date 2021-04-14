<?php

/**
* 
* CidadeService
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CidadeService extends AppService{
    public function autalizarStatusCidade($id, $status);
    public function listarCidadePorStatus($status, $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
}


?>
