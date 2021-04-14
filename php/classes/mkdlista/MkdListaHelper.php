<?php 

// importar dependencias
require_once '../mkdlista/MkdListaBusinessImpl.php';
require_once '../mkdlista/MkdListaServiceImpl.php';

/**
*
* MkdListaHelper - Classe de implementação dos métodos de adaptação para a classe de negócio MkdLista
* Camada de negócio MkdLista - camada responsável pela lógica de negócios de MkdLista do sistema. 
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
* @since 04/11/2019 09:31:13
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class MkdListaHelper
{
    public static function getMkdListaService($mkel_id) {
        $usbo = new MkdListaServiceImpl();
        $dto = $usbo->pesquisarPorID($mkel_id);
        return $dto;
    }

    public static function getMkdListaBusiness($daofactory, $mkel_id) {
        $usbo = new MkdListaBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $mkel_id);
        return $dto;
    }

/**
 * isMkdListaValido() - Verifica o MkdLista é valido com base na PK
 **/    
    public static function isMkdListaValido($daofactory, $mkel_id) {
        $mkeldto = self::getMkdListaBusiness($daofactory, $mkel_id);
        if($mkeldto == NULL || $mkeldto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
