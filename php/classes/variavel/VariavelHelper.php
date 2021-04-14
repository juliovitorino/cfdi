<?php 

// importar dependencias
require_once 'VariavelCache.php';

/**
*
* VariavelHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaCashbackCC
* Camada de negócio CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
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

class VariavelHelper
{

    public static function getVariavel($variavel) {
        return VariavelCache::getInstance()->getVariavel($variavel);
    }
    
}


?>
