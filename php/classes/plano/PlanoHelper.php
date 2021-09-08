<?php 

// importar dependencias
require_once 'PlanoBusinessImpl.php';
require_once 'PlanoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';

/**
*
* PlanoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio Plano
* Camada de negócio Plano - camada responsável pela lógica de negócios de Plano do sistema. 
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
* @since 08/09/2021 14:05:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class PlanoHelper
{
    public static function getPlanoService($plan_id) {
        $usbo = new PlanoServiceImpl();
        $dto = $usbo->pesquisarPorID($plan_id);
        return $dto;
    }

    public static function getPlanoBusiness($daofactory, $plan_id) {
        $usbo = new PlanoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $plan_id);
        return $dto;
    }

/**
 * isPlanoValido() - Verifica o Plano é valido com base na PK
 **/    
    public static function isPlanoValido($daofactory, $plan_id) {
        $plandto = self::getPlanoBusiness($daofactory, $plan_id);
        if($plandto == NULL || $plandto->id == NULL) {
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
