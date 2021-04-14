<?php 

// importar dependencias
require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';

/**
*
* UsuarioHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaCashbackCC
* Camada de negócio CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* É uma classe para apoiar, criar ou evitar que na classe de negócio se crie muitos códigos repetidos para obter apenas
* uma informação ou objeto.
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

class UsuarioHelper
{

    public static function getUsuarioBusiness($daofactory, $id_usuario) {
        $usbo = new UsuarioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $id_usuario);
        return $dto;
    }
    
    public static function getUsuarioBusinessNoKeys($daofactory, $id_usuario) {
        $usbo = new UsuarioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $id_usuario);
        $dto->codigoAtivacao = null;
        $dto->pwd = null;
        return $dto;
    }

/**
 * isUsuarioValido() - Verifica o ${classebase} é valido com base na PK
 **/    
public static function isUsuarioValido($daofactory, $id_usuario) {
    $usuadto = self::getUsuarioBusiness($daofactory, $id_usuario);
    if($usuadto == NULL || $usuadto->id == NULL) {
        return false;
    }
    return true;
}

/**
 * isUsuarioComum() - Verifica o ${classebase} é valido com base na PK
 **/    
public static function isUsuarioComum($daofactory, $id_usuario) {
    $usuadto = self::getUsuarioBusiness($daofactory, $id_usuario);
    if($usuadto == NULL || $usuadto->id == NULL) {
        return false;
    }
    if($usuadto->tipoConta == ConstantesVariavel::CONTA_USUARIO_COMUM){
        return true;
    }
    return false;
}

/**
 * isUsuarioParceiro() - Verifica o ${classebase} é valido com base na PK
 **/    
public static function isUsuarioParceiro($daofactory, $id_usuario) {
    $usuadto = self::getUsuarioBusiness($daofactory, $id_usuario);
    if($usuadto == NULL || $usuadto->id == NULL) {
        return false;
    }
    if($usuadto->tipoConta == ConstantesVariavel::CONTA_USUARIO_PARCEIRO){
        return true;
    }
    return false;
}

}


?>
