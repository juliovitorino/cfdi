<?php 

// importar dependencias
require_once '../usuariopublicidade/UsuarioPublicidadeBusinessImpl.php';
require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';

/**
*
* UsuarioPublicidadeHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioPublicidade
* Camada de negócio UsuarioPublicidade - camada responsável pela lógica de negócios de UsuarioPublicidade do sistema. 
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
* @since 20/09/2019 13:57:12
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioPublicidadeHelper
{
    public static function getUsuarioPublicidadeService($uspu_id) {
        $usbo = new UsuarioPublicidadeServiceImpl();
        $dto = $usbo->pesquisarPorID($uspu_id);
        return $dto;
    }

    public static function getUsuarioPublicidadeBusiness($daofactory, $uspu_id) {
        $usbo = new UsuarioPublicidadeBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $uspu_id);
        return $dto;
    }

/**
 * isUsuarioPublicidadeValido() - Verifica o UsuarioPublicidade é valido com base na PK
 **/    
    public static function isUsuarioPublicidadeValido($daofactory, $uspu_id) {
        $uspudto = self::getUsuarioPublicidadeBusiness($daofactory, $uspu_id);
        if($uspudto == NULL || $uspudto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
