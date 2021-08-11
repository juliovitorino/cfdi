<?php 

// importar dependencias
require_once 'CampanhaCashbackResgatePixBusinessImpl.php';
require_once 'CampanhaCashbackResgatePixServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';

/**
*
* CampanhaCashbackResgatePixHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaCashbackResgatePix
* Camada de negócio CampanhaCashbackResgatePix - camada responsável pela lógica de negócios de CampanhaCashbackResgatePix do sistema. 
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
* @since 26/07/2021 15:11:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaCashbackResgatePixHelper
{
    public static function getCampanhaCashbackResgatePixService($ccrp_id) {
        $usbo = new CampanhaCashbackResgatePixServiceImpl();
        $dto = $usbo->pesquisarPorID($ccrp_id);
        return $dto;
    }

    public static function getCampanhaCashbackResgatePixBusiness($daofactory, $ccrp_id) {
        $usbo = new CampanhaCashbackResgatePixBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $ccrp_id);
        return $dto;
    }

/**
 * isCampanhaCashbackResgatePixValido() - Verifica o CampanhaCashbackResgatePix é valido com base na PK
 **/    
    public static function isCampanhaCashbackResgatePixValido($daofactory, $ccrp_id) {
        $ccrpdto = self::getCampanhaCashbackResgatePixBusiness($daofactory, $ccrp_id);
        if($ccrpdto == NULL || $ccrpdto->id == NULL) {
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

public static function criarNotificacaoAdmin($daofactory, $msgOrigem, $parametros, $icone="money.png")
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
