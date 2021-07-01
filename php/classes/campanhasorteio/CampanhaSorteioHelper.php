<?php 

// importar dependencias
require_once '../campanhasorteio/CampanhaSorteioBusinessImpl.php';
require_once '../campanhasorteio/CampanhaSorteioServiceImpl.php';

/**
*
* CampanhaSorteioHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaSorteio
* Camada de negócio CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* É uma classe para apoiar, criar ou evitar que na classe de negócio se crie muitos códigos repetidos para obter apenas
* uma informação ou objeto.
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 16/06/2021 12:57:19
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioHelper
{
    public static function getCampanhaSorteioService($caso_id) {
        $usbo = new CampanhaSorteioServiceImpl();
        $dto = $usbo->pesquisarPorID($caso_id);
        return $dto;
    }

    public static function getCampanhaSorteioBusiness($daofactory, $caso_id) {
        $usbo = new CampanhaSorteioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $caso_id);
        return $dto;
    }

/**
 * isCampanhaSorteioValido() - Verifica o CampanhaSorteio é valido com base na PK
 **/    
    public static function isCampanhaSorteioValido($daofactory, $caso_id) {
        $casodto = self::getCampanhaSorteioBusiness($daofactory, $caso_id);
        if($casodto == NULL || $casodto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
