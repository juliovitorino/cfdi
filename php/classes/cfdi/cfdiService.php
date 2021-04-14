<?php

/**
 * 
 * CfdiService
 */

// importar dependências

require_once '../interfaces/AppService.php';

interface CfdiService extends AppService{

    public function pesquisarPorCarimbo($qrc);

}


?>