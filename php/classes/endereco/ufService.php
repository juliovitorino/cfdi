<?php

/**
* 
* UfService
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UfService extends AppService{
    public function autalizarStatusUf($id, $status);
    public function listarUfPorStatus($status, $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);

}
?>
