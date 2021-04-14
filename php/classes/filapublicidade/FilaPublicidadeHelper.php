<?php 

// importar dependencias
require_once '../filapublicidade/FilaPublicidadeBusinessImpl.php';
require_once '../filapublicidade/FilaPublicidadeServiceImpl.php';

/**
*
* FilaPublicidadeHelper - Classe de implementação dos métodos de adaptação para a classe de negócio FilaPublicidade
* Camada de negócio FilaPublicidade - camada responsável pela lógica de negócios de FilaPublicidade do sistema. 
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
* @since 19/09/2019 15:04:11
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaPublicidadeHelper
{
    public static function getFilaPublicidadeService($fipu_id) {
        $usbo = new FilaPublicidadeServiceImpl();
        $dto = $usbo->pesquisarPorID($fipu_id);
        return $dto;
    }

    public static function getFilaPublicidadeBusiness($daofactory, $fipu_id) {
        $usbo = new FilaPublicidadeBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $fipu_id);
        return $dto;
    }

/**
 * isFilaPublicidadeValido() - Verifica o FilaPublicidade é valido com base na PK
 **/    
    public static function isFilaPublicidadeValido($daofactory, $fipu_id) {
        $fipudto = self::getFilaPublicidadeBusiness($daofactory, $fipu_id);
        if($fipudto == NULL || $fipudto->id == NULL) {
            return true;
        }
        return false;
    }
    
}


?>
