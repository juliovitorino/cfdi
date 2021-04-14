<?php

// importar dependencias
require_once '../dto/DTOPadrao.php';

/**
 * Data Transfer Object
 *
 * @category   php.classes
 * @package    campanha
 * @author     Julio Vitorino <julio.vitorino@gmail.com>
 * @copyright  2019-2019 The JCV Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      27/05/2019
 * @deprecated Class deprecated in Release 2.0.0
 */
class CartaoFullDTO extends DTOPadrao implements JsonSerializable
{
    public $cartao;
    public $campanha;
    public $usuario;
    public $parceiro;
    
    public function jsonSerialize()
    {
        return 
        [
            'cartao'   => $this->cartao == NULL ? NULL : $this->cartao->jsonSerialize(),
            'campanha' => $this->campanha == NULL ? NULL : $this->campanha->jsonSerialize(),
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'parceiro' => $this->parceiro == NULL ? NULL : $this->parceiro->jsonSerialize(),
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
