<?php 

// importar dependencias
require_once '../filaqrcodependenteproduzir/FilaQRCodePendenteProduzirBusinessImpl.php';
require_once '../filaqrcodependenteproduzir/FilaQRCodePendenteProduzirServiceImpl.php';

/**
*
* FilaQRCodePendenteProduzirHelper - Classe de implementação dos métodos de adaptação para a classe de negócio FilaQRCodePendenteProduzir
* Camada de negócio FilaQRCodePendenteProduzir - camada responsável pela lógica de negócios de FilaQRCodePendenteProduzir do sistema. 
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
* @since 26/10/2019 10:27:47
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaQRCodePendenteProduzirHelper
{
    public static function getFilaQRCodePendenteProduzirService($fqpp_id) {
        $usbo = new FilaQRCodePendenteProduzirServiceImpl();
        $dto = $usbo->pesquisarPorID($fqpp_id);
        return $dto;
    }

    public static function getFilaQRCodePendenteProduzirBusiness($daofactory, $fqpp_id) {
        $usbo = new FilaQRCodePendenteProduzirBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $fqpp_id);
        return $dto;
    }

/**
 * isFilaQRCodePendenteProduzirValido() - Verifica o FilaQRCodePendenteProduzir é valido com base na PK
 **/    
    public static function isFilaQRCodePendenteProduzirValido($daofactory, $fqpp_id) {
        $fqppdto = self::getFilaQRCodePendenteProduzirBusiness($daofactory, $fqpp_id);
        if($fqppdto == NULL || $fqppdto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
