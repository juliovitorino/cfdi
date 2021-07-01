<?php 

// importar dependencias
require_once 'CampanhaSorteioNumerosPermitidosBusinessImpl.php';
require_once 'CampanhaSorteioNumerosPermitidosServiceImpl.php';

/**
*
* CampanhaSorteioNumerosPermitidosHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaSorteioNumerosPermitidos
* Camada de negócio CampanhaSorteioNumerosPermitidos - camada responsável pela lógica de negócios de CampanhaSorteioNumerosPermitidos do sistema. 
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
* @since 17/06/2021 17:44:16
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioNumerosPermitidosHelper
{
    public static function getCampanhaSorteioNumerosPermitidosService($csnp_id) {
        $usbo = new CampanhaSorteioNumerosPermitidosServiceImpl();
        $dto = $usbo->pesquisarPorID($csnp_id);
        return $dto;
    }

    public static function getCampanhaSorteioNumerosPermitidosBusiness($daofactory, $csnp_id) {
        $usbo = new CampanhaSorteioNumerosPermitidosBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $csnp_id);
        return $dto;
    }

/**
 * isCampanhaSorteioNumerosPermitidosValido() - Verifica o CampanhaSorteioNumerosPermitidos é valido com base na PK
 **/    
    public static function isCampanhaSorteioNumerosPermitidosValido($daofactory, $csnp_id) {
        $csnpdto = self::getCampanhaSorteioNumerosPermitidosBusiness($daofactory, $csnp_id);
        if($csnpdto == NULL || $csnpdto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>

