<?php

/**
* 
* UsuarioTipoEmpreendimentoService
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioTipoEmpreendimentoService extends AppService{
    public function autalizarStatusUsuarioTipoEmpreendimento($id, $status);
    public function listarUsuarioTipoEmpreendimentoPorStatus($status);
    public function cancelar($dto);
}
?>
