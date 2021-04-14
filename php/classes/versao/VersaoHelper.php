<?php 

// importar dependencias
require_once '../versao/VersaoBusinessImpl.php';
require_once '../versao/VersaoServiceImpl.php';

/**
*
* VersaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio Versao
* Camada de negócio Versao - camada responsável pela lógica de negócios de Versao do sistema. 
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
* @since 06/10/2019 15:59:51
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class VersaoHelper
{
    public static function getVersaoService($vers_id) {
        $usbo = new VersaoServiceImpl();
        $dto = $usbo->pesquisarPorID($vers_id);
        return $dto;
    }

    public static function getVersaoBusiness($daofactory, $vers_id) {
        $usbo = new VersaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $vers_id);
        return $dto;
    }

/**
 * isVersaoValido() - Verifica o Versao é valido com base na PK
 **/    
    public static function isVersaoValido($daofactory, $vers_id) {
        $versdto = self::getVersaoBusiness($daofactory, $vers_id);
        if($versdto == NULL || $versdto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
