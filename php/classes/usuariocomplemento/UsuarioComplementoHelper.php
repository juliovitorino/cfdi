<?php 

// importar dependencias
require_once 'UsuarioComplementoBusinessImpl.php';
require_once 'UsuarioComplementoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* UsuarioComplementoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioComplemento
* Camada de negócio UsuarioComplemento - camada responsável pela lógica de negócios de UsuarioComplemento do sistema. 
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
* @since 07/09/2021 10:21:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioComplementoHelper
{
    public static function getUsuarioComplementoService($usco_id) {
        $usbo = new UsuarioComplementoServiceImpl();
        $dto = $usbo->pesquisarPorID($usco_id);
        return $dto;
    }

    public static function getUsuarioComplementoBusiness($daofactory, $usco_id) {
        $usbo = new UsuarioComplementoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $usco_id);
        return $dto;
    }

/**
 * isUsuarioComplementoValido() - Verifica o UsuarioComplemento é valido com base na PK
 **/    
    public static function isUsuarioComplementoValido($daofactory, $usco_id) {
        $uscodto = self::getUsuarioComplementoBusiness($daofactory, $usco_id);
        if($uscodto == NULL || $uscodto->id == NULL) {
            return true;
        }
        return false;
    }

/**
*
* criarNotificacaoAdmin - Ajuda para publicar uma notificação ao usuário Admin
*
* @param $daofactory
* @param $msgOrigem
* @param $parametros
* @param $icone
*
*/

public static function criarNotificacaoAdmin($daofactory, $msgOrigem, $parametros, $icone)
{
    // Envia uma notificação ao ADMIN se chave estiver ligada
    if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
        $usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
        $msg =  MensagemCache::getInstance()->getMensagemParametrizada($msgOrigem,$parametros);
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, $icone);
    }
    
}

    
}


?>
