<?php 

// importar dependencias
require_once '../cartaopedido/CartaoPedidoBusinessImpl.php';
require_once '../cartaopedido/CartaoPedidoServiceImpl.php';

/**
*
* CartaoPedidoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CartaoPedido
* Camada de negócio CartaoPedido - camada responsável pela lógica de negócios de CartaoPedido do sistema. 
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
* @since 17/09/2019 13:56:32
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CartaoPedidoHelper
{
    public static function getCartaoPedidoService($cape_id) {
        $usbo = new CartaoPedidoServiceImpl();
        $dto = $usbo->pesquisarPorID($cape_id);
        return $dto;
    }

    public static function getCartaoPedidoBusiness($daofactory, $cape_id) {
        $usbo = new CartaoPedidoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $cape_id);
        return $dto;
    }

/**
 * isCartaoPedidoValido() - Verifica o CartaoPedido é valido com base na PK
 **/    
    public static function isCartaoPedidoValido($daofactory, $cape_id) {
        $capedto = self::getCartaoPedidoBusiness($daofactory, $cape_id);
        if($capedto == NULL || $capedto->id == NULL) {
            return true;
        }
        return false;
    }
    
}

?>
