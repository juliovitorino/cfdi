<?php

/**
* 
* UsuarioComplementoService
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioComplementoService extends AppService
{
    public function autalizarStatusUsuarioComplemento($id, $status);
    public function listarUsuarioComplementoPorStatus($status, $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
}
?>
