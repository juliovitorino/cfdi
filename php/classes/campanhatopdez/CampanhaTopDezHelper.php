<?php 

// importar dependencias
require_once '../campanhatopdez/CampanhaTopDezBusinessImpl.php';
require_once '../campanhatopdez/CampanhaTopDezServiceImpl.php';

/**
*
* CampanhaTopDezHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaTopDez
* Camada de negócio CampanhaTopDez - camada responsável pela lógica de negócios de CampanhaTopDez do sistema. 
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
* @since 19/09/2019 08:36:54
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaTopDezHelper
{
    public static function getCampanhaTopDezService($cato_id) {
        $usbo = new CampanhaTopDezServiceImpl();
        $dto = $usbo->pesquisarPorID($cato_id);
        return $dto;
    }

    public static function getCampanhaTopDezBusiness($daofactory, $cato_id) {
        $usbo = new CampanhaTopDezBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $cato_id);
        return $dto;
    }

/**
 * isCampanhaTopDezValido() - Verifica o CampanhaTopDez é valido com base na PK
 **/    
    public static function isCampanhaTopDezValido($daofactory, $cato_id) {
        $catodto = self::getCampanhaTopDezBusiness($daofactory, $cato_id);
        if($catodto == NULL || $catodto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
