<?php 

// importar dependencias
require_once 'CampanhaSorteioFilaCriacaoBusinessImpl.php';
require_once 'CampanhaSorteioFilaCriacaoServiceImpl.php';

/**
*
* CampanhaSorteioFilaCriacaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaSorteioFilaCriacao
* Camada de negócio CampanhaSorteioFilaCriacao - camada responsável pela lógica de negócios de CampanhaSorteioFilaCriacao do sistema. 
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
* @since 17/06/2021 08:04:03
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioFilaCriacaoHelper
{
    public static function getCampanhaSorteioFilaCriacaoService($csfc_id) {
        $usbo = new CampanhaSorteioFilaCriacaoServiceImpl();
        $dto = $usbo->pesquisarPorID($csfc_id);
        return $dto;
    }

    public static function getCampanhaSorteioFilaCriacaoBusiness($daofactory, $csfc_id) {
        $usbo = new CampanhaSorteioFilaCriacaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $csfc_id);
        return $dto;
    }

/**
 * isCampanhaSorteioFilaCriacaoValido() - Verifica o CampanhaSorteioFilaCriacao é valido com base na PK
 **/    
    public static function isCampanhaSorteioFilaCriacaoValido($daofactory, $csfc_id) {
        $csfcdto = self::getCampanhaSorteioFilaCriacaoBusiness($daofactory, $csfc_id);
        if($csfcdto == NULL || $csfcdto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
