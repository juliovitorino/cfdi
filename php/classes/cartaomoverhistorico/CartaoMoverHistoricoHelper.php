<?php 

// importar dependencias
require_once 'CartaoMoverHistoricoBusinessImpl.php';
require_once 'CartaoMoverHistoricoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';

/**
*
* CartaoMoverHistoricoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CartaoMoverHistorico
* Camada de negócio CartaoMoverHistorico - camada responsável pela lógica de negócios de CartaoMoverHistorico do sistema. 
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
* @since 24/07/2021 10:20:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CartaoMoverHistoricoHelper
{
    public static function getCartaoMoverHistoricoService($camh_id) {
        $usbo = new CartaoMoverHistoricoServiceImpl();
        $dto = $usbo->pesquisarPorID($camh_id);
        return $dto;
    }

    public static function getCartaoMoverHistoricoBusiness($daofactory, $camh_id) {
        $usbo = new CartaoMoverHistoricoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $camh_id);
        return $dto;
    }

/**
 * isCartaoMoverHistoricoValido() - Verifica o CartaoMoverHistorico é valido com base na PK
 **/    
    public static function isCartaoMoverHistoricoValido($daofactory, $camh_id) {
        $camhdto = self::getCartaoMoverHistoricoBusiness($daofactory, $camh_id);
        if($camhdto == NULL || $camhdto->id == NULL) {
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
        self::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, $icone);
    }
    
}

    
}


?>
