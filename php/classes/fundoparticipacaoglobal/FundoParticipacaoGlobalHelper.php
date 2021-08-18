<?php 

// importar dependencias
require_once 'FundoParticipacaoGlobalBusinessImpl.php';
require_once 'FundoParticipacaoGlobalServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* FundoParticipacaoGlobalHelper - Classe de implementação dos métodos de adaptação para a classe de negócio FundoParticipacaoGlobal
* Camada de negócio FundoParticipacaoGlobal - camada responsável pela lógica de negócios de FundoParticipacaoGlobal do sistema. 
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
* @since 18/08/2021 11:48:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FundoParticipacaoGlobalHelper
{
    public static function getFundoParticipacaoGlobalService($fpgl_id) {
        $usbo = new FundoParticipacaoGlobalServiceImpl();
        $dto = $usbo->pesquisarPorID($fpgl_id);
        return $dto;
    }

    public static function getFundoParticipacaoGlobalBusiness($daofactory, $fpgl_id) {
        $usbo = new FundoParticipacaoGlobalBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $fpgl_id);
        return $dto;
    }

/**
 * isFundoParticipacaoGlobalValido() - Verifica o FundoParticipacaoGlobal é valido com base na PK
 **/    
    public static function isFundoParticipacaoGlobalValido($daofactory, $fpgl_id) {
        $fpgldto = self::getFundoParticipacaoGlobalBusiness($daofactory, $fpgl_id);
        if($fpgldto == NULL || $fpgldto->id == NULL) {
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
