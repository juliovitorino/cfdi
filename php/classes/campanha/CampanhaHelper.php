<?php 

// importar dependencias
require_once 'campanhaBusinessImpl.php';
require_once 'campanhaServiceImpl.php';

/**
*
* CampanhaHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaCC
* Camada de negócio CampanhaCC - camada responsável pela lógica de negócios de CampanhaCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* É uma classe para apoiar, criar ou evitar que na classe de negócio se crie muitos códigos repetidos para obter apenas
* uma informação ou objeto.
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

class CampanhaHelper
{
    public static function getCampanhaBusinessDTO($daofactory, $id_campanha)
    {
        $bo = new CampanhaBusinessImpl();
        $dto = $bo->carregarPorID($daofactory, $id_campanha);
        return $dto;
    }

    public static function getCampanhaService($id_campanha) {
        $usbo = new CampanhaServiceImpl();
        $dto = $usbo->pesquisarPorID($id_campanha);
        return $dto;
    }

    public static function getCampanhaBusiness($daofactory, $id_campanha) {
        $usbo = new CampanhaBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $id_campanha);
        return $dto;
    }

   
    
}


?>
