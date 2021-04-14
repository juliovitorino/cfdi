<?php 

// importar dependencias
require_once 'UsuarioAvaliacaoBusinessImpl.php';
require_once 'UsuarioAvaliacaoServiceImpl.php';

/**
*
* UsuarioAvaliacaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioAvaliacao
* Camada de negócio UsuarioAvaliacao - camada responsável pela lógica de negócios de UsuarioAvaliacao do sistema. 
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
* @since 17/09/2019 09:22:19
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioAvaliacaoHelper
{
    public static function getUsuarioAvaliacaoService($usav_id) {
        $usbo = new UsuarioAvaliacaoServiceImpl();
        $dto = $usbo->pesquisarPorID($usav_id);
        return $dto;
    }

    public static function getUsuarioAvaliacaoBusiness($daofactory, $usav_id) {
        $usbo = new UsuarioAvaliacaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $usav_id);
        return $dto;
    }
    
    
}


?>
