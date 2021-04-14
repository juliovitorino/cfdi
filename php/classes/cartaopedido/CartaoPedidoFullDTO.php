<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
require_once '../plano/PlanoDTO.php';

/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
* CartaoPedidoFullDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 17/09/2019 13:56:32
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CartaoPedidoFullDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $cartaopedido;
    public $plano;

    public function jsonSerialize()
    {
        return 
        [
            'cartaopedido' => $this->cartaopedido == NULL ? NULL : $this->cartaopedido->jsonSerialize(),
            'plano' => $this->plano == NULL ? NULL : $this->plano->jsonSerialize(),
            'statusdesc' => $this->statusdesc,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }   
}
?>
