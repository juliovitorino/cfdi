<?php 

// importar dependencias
require_once '../usuarioversao/UsuarioVersaoBusinessImpl.php';
require_once '../usuarioversao/UsuarioVersaoServiceImpl.php';

/**
*
* UsuarioVersaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioVersao
* Camada de negócio UsuarioVersao - camada responsável pela lógica de negócios de UsuarioVersao do sistema. 
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
* @since 06/10/2019 16:44:47
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioVersaoHelper
{
    public static function getUsuarioVersaoService($usve_id) {
        $usbo = new UsuarioVersaoServiceImpl();
        $dto = $usbo->pesquisarPorID($usve_id);
        return $dto;
    }

    public static function getUsuarioVersaoBusiness($daofactory, $usve_id) {
        $usbo = new UsuarioVersaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $usve_id);
        return $dto;
    }

/**
 * isUsuarioVersaoValido() - Verifica o UsuarioVersao é valido com base na PK
 **/    
    public static function isUsuarioVersaoValido($daofactory, $usve_id) {
        $usvedto = self::getUsuarioVersaoBusiness($daofactory, $usve_id);
        if($usvedto == NULL || $usvedto->id == NULL) {
            return true;
        }
        return false;
    }
    
}

?>
