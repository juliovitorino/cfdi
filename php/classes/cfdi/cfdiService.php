<?php

/**
 * 
 * CfdiService
 */

// importar dependĂȘncias

require_once '../interfaces/AppService.php';

interface CfdiService extends AppService{

    public function pesquisarPorCarimbo($qrc);

}


?>